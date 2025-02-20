<link rel="stylesheet" href="<?php echo MOD_URL.$module;?>/assets/css/customroster.css">
<body>
    <div class="card mb-4">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h4 class="mb-3"><?php echo display('roster_empatn') ?></h4>
                    <input class="form-control calendar_width shiftdate" type="text" name="changedate" onchange="cngdata()"  id="changedrsdate" />
                </div>
                <div class="col-lg-6">
                    <div class="stat-wrap">
                        <div class="stat-title">
                            <h6><?php echo display('today_crnt_shift') ?>:</h6>
                        </div>
                        <div class="stat-inner">
                            <?php 
                            $cr_time =  date("Y-m-d H:i");
                            $this->db->select('tbl_emproster_assign.*');
                            $this->db->from('tbl_emproster_assign');
                            
                            $this->db->where('cast(concat(tbl_emproster_assign.emp_startroster_date, " ", tbl_emproster_assign.emp_startroster_time) as datetime) <= ',$cr_time);
                            $this->db->where('cast(concat(tbl_emproster_assign.emp_endroster_date," ", tbl_emproster_assign.emp_endroster_time) as datetime) >=',$cr_time);
                            $this->db->where('is_complete',1);
                            $query=$this->db->get();
                            $attenddata=$query->num_rows();
                            $array1 = array('is_complete !=' => 1);
                            $abdata=$this->db->select('*')->from('tbl_emproster_assign')
                            ->where('cast(concat(emp_startroster_date, " ",emp_startroster_time) as datetime) <= ',$cr_time)
                            ->where('cast(concat(emp_endroster_date," ",emp_endroster_time) as datetime) >=',$cr_time)
                            ->where('is_complete !=',1)
                            
                            ->get()
                            ->num_rows();
                            ?>
                            <span class="stat-number"><?php echo html_escape($attenddata) ;?></span>
                            <span class="stat-title text-success"><?php echo display('attend') ?></span>
                        </div>
                        <div class="stat-inner">
                            <span class="stat-number"><?php echo html_escape($abdata) ;?></span>
                            <span class="stat-title text-danger"><?php echo display('absent') ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>        
    </div>

    <div class="card" id="main_data">
        
    </div>
</body>
</html>
<script src="<?php echo MOD_URL.$module;?>/assets/js/dashboard_footer.js"></script>
