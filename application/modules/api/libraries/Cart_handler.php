<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart_handler {
    /**
     * CI instance
     * @var object
     */
    protected $CI;

    /**
     * Shopping cart items and totals
     * @var array
     */
    protected $cart_contents = array();

    /**
     * Cache key prefix for cart data
     * @var string
     */
    protected $cache_prefix = 'api_cart_';

    /**
     * Cart expiration time in seconds
     * @var int
     */
    protected $expiration = 7200; // 2 hours to match API session

    /**
     * Required fields for cart items
     * @var array
     */
    protected $required_fields = ['id', 'qty', 'price', 'name'];

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->CI =& get_instance();

        // Set unique cache ID using IP and user agent
        $cache_id = $this->cache_prefix . md5($this->CI->input->ip_address() . $this->CI->input->user_agent());

        // Get cart data from cache
        $cached_cart = $this->CI->cache->get($cache_id);
        
        if ($cached_cart !== FALSE) {
            $this->cart_contents = $cached_cart;
        } else {
            // Initialize empty cart
            $this->cart_contents = array('cart_total' => 0, 'total_items' => 0);
            $this->_save_cart();
        }



    }

    public function cache_id()
    {
        return $this->cache_prefix . md5($this->CI->input->ip_address() . $this->CI->input->user_agent());
    }

    /**
     * Insert items into the cart and save it to cache
     * 
     * @param array $items
     * @return bool
     */
    public function insert($items = array())
    {
        // Was any cart data passed?
        if (!is_array($items) OR count($items) === 0) {
            return FALSE;
        }

        $save_cart = FALSE;
        if (isset($items['id'])) {
            if ($this->_insert($items)) {
                $save_cart = TRUE;
            }
        } else {
            foreach ($items as $val) {
                if (is_array($val) && isset($val['id'])) {
                    if ($this->_insert($val)) {
                        $save_cart = TRUE;
                    }
                }
            }
        }

        // Save the cart data if the insert was successful
        if ($save_cart === TRUE) {
            $this->_save_cart();
            return TRUE;
        }

        return FALSE;
    }

    /**
     * Update the cart
     * 
     * @param array $items
     * @return bool
     */
    public function update($items = array())
    {
        if (!is_array($items) OR count($items) === 0) {
            return FALSE;
        }

        $save_cart = FALSE;
        if (isset($items['rowid'])) {
            if ($this->_update($items) === TRUE) {
                $save_cart = TRUE;
            }
        } else {
            foreach ($items as $val) {
                if (is_array($val) && isset($val['rowid'])) {
                    if ($this->_update($val) === TRUE) {
                        $save_cart = TRUE;
                    }
                }
            }
        }

        // Save the cart data if the update was successful
        if ($save_cart === TRUE) {
            $this->_save_cart();
            return TRUE;
        }

        return FALSE;
    }

    /**
     * Remove an item from the cart
     * 
     * @param int $rowid
     * @return void
     */
    public function remove($rowid)
    {
        unset($this->cart_contents[$rowid]);
        $this->_save_cart();
    }

    /**
     * Empty the cart
     * 
     * @return void
     */
    public function destroy()
    {
        $this->cart_contents = array('cart_total' => 0, 'total_items' => 0);
        $this->CI->cache->delete($this->cache_id());
    }

    /**
     * Get cart contents
     * 
     * @return array
     */
    public function contents()
    {
        // Get fresh copy from cache
        $cache_id = $this->cache_prefix . md5($this->CI->input->ip_address() . $this->CI->input->user_agent());
        $cart = $this->CI->cache->get($cache_id);
        
        if ($cart === FALSE) {
            return array();
        }
        
        // Remove these so they don't create a problem when showing the cart table
        unset($cart['total_items']);
        unset($cart['cart_total']);

        return $cart;
    }

    /**
     * Get cart total
     * 
     * @return float
     */
    public function total()
    {
        return $this->cart_contents['cart_total'];
    }

    /**
     * Get total items in cart
     * 
     * @return int
     */
    public function total_items()
    {
        return $this->cart_contents['total_items'];
    }

    /**
     * Insert a single item into the cart
     * 
     * @param array $item
     * @return bool
     */
    protected function _insert($item = array())
    {
        if (!is_array($item) OR count($item) === 0) {
            return FALSE;
        }

        // Validate required fields
        foreach ($this->required_fields as $field) {
            if (!isset($item[$field])) {
                return FALSE;
            }
        }

        // Prep the quantity
        $item['qty'] = (float) $item['qty'];
        if ($item['qty'] == 0) {
            return FALSE;
        }

        // Prep the price
        $item['price'] = (float) $item['price'];

        // Create a unique identifier using all item data
        $rowid = md5($item['id'] . serialize($item));

        // Calculate subtotal
        $item['subtotal'] = $item['price'] * $item['qty'];

        // Add rowid to item
        $item['rowid'] = $rowid;

        // Let's unset this first, just to make sure
        unset($this->cart_contents[$rowid]);

        // Add item to cart
        $this->cart_contents[$rowid] = $item;

        // Update cart totals
        $this->_update_cart_total();

        return TRUE;
    }

    /**
     * Update the quantity of an item in the cart
     * 
     * @param array $item
     * @return bool
     */
    protected function _update($item = array())
    {
        // Without these array indexes there is nothing we can do
        if (!isset($item['rowid'], $this->cart_contents[$item['rowid']])) {
            return FALSE;
        }

        // Prep the quantity
        if (isset($item['qty'])) {
            $item['qty'] = (float) $item['qty'];
            // Is the quantity zero? If so we will remove the item from the cart
            if ($item['qty'] == 0) {
                unset($this->cart_contents[$item['rowid']]);
                return TRUE;
            }
        }

        // Find updatable keys
        $keys = array_intersect(array_keys($this->cart_contents[$item['rowid']]), array_keys($item));

        // If price was passed, make sure it contains valid data
        if (isset($item['price'])) {
            $item['price'] = (float) $item['price'];
        }

        // Product ID & name shouldn't be changed
        foreach (array_diff($keys, array('id', 'name')) as $key) {
            $this->cart_contents[$item['rowid']][$key] = $item[$key];
        }

        // Update subtotal if price or qty changed
        if (isset($item['price']) || isset($item['qty'])) {
            $this->cart_contents[$item['rowid']]['subtotal'] = 
                $this->cart_contents[$item['rowid']]['price'] * 
                $this->cart_contents[$item['rowid']]['qty'];
        }

        // Update cart total
        $this->_update_cart_total();

        return TRUE;
    }

    /**
     * Update the cart total and item count
     * 
     * @return void
     */
    protected function _update_cart_total()
    {
        $total = 0;
        $items = 0;

        foreach ($this->cart_contents as $row) {
            if (!is_array($row) OR !isset($row['price'], $row['qty'])) {
                continue;
            }

            $total += $row['price'] * $row['qty'];
            $items += $row['qty'];
        }

        $this->cart_contents['total_items'] = $items;
        $this->cart_contents['cart_total'] = $total;
    }

    /**
     * Save the cart array to cache
     * 
     * @return void
     */
    protected function _save_cart()
    {
        // Save with 2 hour expiration by default
        $cache_id = $this->cache_prefix . md5($this->CI->input->ip_address() . $this->CI->input->user_agent());
        $this->CI->cache->save($cache_id, $this->cart_contents, $this->expiration);

        // Return cart data if AJAX request
        if ($this->CI->input->is_ajax_request()) {
            $this->CI->output
                ->set_content_type('application/json')
                ->set_output(json_encode(array(
                    'total_items' => $this->total_items(),
                    'cart_total' => $this->total(),
                    'cart_contents' => $this->contents()
                )));
        }
    }
}
