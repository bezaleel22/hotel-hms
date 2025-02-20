<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- Menu Header -->
<div class="menu-header">
    <div class="container">
        <div class="menu-title text-center mb-4">
            <h2><?php echo display('our_menu'); ?></h2>
            <p class="text-muted"><?php echo display('select_from_our_menu'); ?></p>
        </div>
        
        <!-- Search and Filter -->
        <div class="menu-search mb-4">
            <div class="row">
                <div class="col-md-8 mx-auto">
                    <div class="input-group">
                        <input type="text" id="menu-search" class="form-control" placeholder="<?php echo display('menu_search'); ?>">
                        <div class="input-group-append">
                            <button class="btn btn-outline-primary" type="button">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Categories -->
<div class="menu-categories mb-4">
    <div class="container">
        <div class="row category-slider">
            <?php foreach($categories as $category): ?>
            <div class="col-4 col-md-3 mb-3">
                <a href="<?php echo base_url('menu/category/'.$category->CategoryID); ?>" 
                   class="category-item text-center" 
                   data-category="<?php echo $category->CategoryID; ?>">
                    <div class="category-icon mb-2">
                        <?php if($category->CategoryImage): ?>
                            <img src="<?php echo base_url($category->CategoryImage); ?>" alt="<?php echo $category->Name; ?>" class="img-fluid">
                        <?php else: ?>
                            <i class="fa fa-cutlery fa-2x"></i>
                        <?php endif; ?>
                    </div>
                    <h6 class="category-name"><?php echo $category->Name; ?></h6>
                </a>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<!-- Featured Items -->
<?php if(!empty($featured_items)): ?>
<div class="featured-items mb-5">
    <div class="container">
        <h4 class="section-title mb-4"><?php echo display('featured_items'); ?></h4>
        <div class="row">
            <?php foreach($featured_items as $item): ?>
            <div class="col-6 col-md-3 mb-4">
                <div class="menu-item-card">
                    <a href="<?php echo base_url('menu/item/'.$item->ProductsID); ?>" class="menu-item-link">
                        <?php if($item->ProductImage): ?>
                        <div class="item-image mb-3">
                            <img src="<?php echo base_url($item->ProductImage); ?>" alt="<?php echo $item->ProductName; ?>" class="img-fluid">
                        </div>
                        <?php endif; ?>
                        <div class="item-info p-3">
                            <h5 class="item-title"><?php echo $item->ProductName; ?></h5>
                            <?php if($item->variantid): ?>
                            <div class="item-price">
                                <?php echo $settings['currency_symbol'].$item->price; ?>
                            </div>
                            <?php endif; ?>
                            <?php if($item->descrip): ?>
                            <p class="item-description text-muted small mb-0">
                                <?php echo character_limiter($item->descrip, 60); ?>
                            </p>
                            <?php endif; ?>
                        </div>
                    </a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<?php endif; ?>

<!-- Cart Float Button -->
<a href="<?php echo base_url('menu/cart'); ?>" class="cart-float-btn">
    <i class="fa fa-shopping-cart"></i>
    <span class="cart-count" id="cart-count">0</span>
</a>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize search functionality
    const searchInput = document.getElementById('menu-search');
    searchInput.addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        const items = document.querySelectorAll('.menu-item-card');
        
        items.forEach(item => {
            const title = item.querySelector('.item-title').textContent.toLowerCase();
            const desc = item.querySelector('.item-description')?.textContent.toLowerCase() || '';
            
            if(title.includes(searchTerm) || desc.includes(searchTerm)) {
                item.style.display = '';
            } else {
                item.style.display = 'none';
            }
        });
    });
    
    // Update cart count
    function updateCartCount() {
        const cartCount = document.getElementById('cart-count');
        fetch('<?php echo base_url("menu/get_cart_count"); ?>')
            .then(response => response.json())
            .then(data => {
                cartCount.textContent = data.count;
                if(data.count > 0) {
                    cartCount.style.display = 'block';
                } else {
                    cartCount.style.display = 'none';
                }
            });
    }
    
    // Initial cart count
    updateCartCount();
    
    // Update cart count every 30 seconds
    setInterval(updateCartCount, 30000);
});
</script>

<style>
/* Menu Styles */
.menu-header {
    background-color: <?php echo $settings['theme_primary_color']; ?>;
    color: #fff;
    padding: 2rem 0;
    margin-bottom: 2rem;
}

.category-item {
    display: block;
    text-decoration: none;
    color: #333;
    padding: 1rem;
    border-radius: 8px;
    transition: all 0.3s ease;
}

.category-item:hover {
    background-color: <?php echo $settings['theme_secondary_color']; ?>;
    color: #fff;
    transform: translateY(-5px);
}

.menu-item-card {
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
}

.menu-item-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

.menu-item-link {
    text-decoration: none;
    color: inherit;
}

.item-image {
    height: 200px;
    overflow: hidden;
}

.item-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.cart-float-btn {
    position: fixed;
    bottom: 2rem;
    right: 2rem;
    background-color: <?php echo $settings['theme_primary_color']; ?>;
    color: #fff;
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    box-shadow: 0 2px 8px rgba(0,0,0,0.2);
    transition: all 0.3s ease;
}

.cart-float-btn:hover {
    transform: scale(1.1);
    color: #fff;
}

.cart-count {
    position: absolute;
    top: 0;
    right: 0;
    background-color: #dc3545;
    color: #fff;
    border-radius: 50%;
    width: 24px;
    height: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 12px;
}

/* Dark Mode Styles */
<?php if(isset($settings['enable_dark_mode']) && $settings['enable_dark_mode']): ?>
body {
    background-color: #1a1a1a;
    color: #fff;
}

.menu-item-card {
    background-color: #2d2d2d;
}

.category-item {
    color: #fff;
    background-color: #2d2d2d;
}

.text-muted {
    color: #999 !important;
}
<?php endif; ?>
</style>