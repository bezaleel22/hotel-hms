<div class="section">
    <div class="container">
        <?php $terms = $this->db->select('*')->from('tbl_widget')->where('widgetid', 38)->get()->row(); ?>
        <h2><?php echo html_escape($terms->widget_title); ?></h2>
        <hr />
        <?php
        // array_explode by .
        $list = explode(".", trim($terms->widget_desc, "."));
        // foreach with key and value
        foreach ($list as $key => $value) {
            $serial = $key + 1;
            echo "<p>" . $serial . '.' . html_escape($value) . "</p>";
        }
        //  echo html_escape($terms->widget_desc); 

        ?>
    </div>
</div>