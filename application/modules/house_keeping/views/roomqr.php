<link type="text/css" href="<?php echo MOD_URL.$module;?>/assets/css/roomqr.css">

<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="card">

            <div class="card-header">
                <h4>All Room QR Code<small class="float-right"><a class="btn btn-info"
                            onclick="printContent('printArea')" title="Print"><span class="fa fa-print"></span>
                        </a></small></h4>
            </div>
            <div class="card-body qr-list d-flex flex-wrap">

                <?php if (!empty($roomlist)) { ?>
                <?php $sl = 1; ?>
                <?php foreach ($roomlist as $room) { ?>
                <div class="col-md-2 qr-back-padding">
                    <img src="https://chart.apis.google.com/chart?cht=qr&amp;chs=200x210&amp;chl=<?php echo html_escape($room->roomno); ?>&amp;chld=H|0"
                        alt="qr1" class="w-50">
                    <p class="w-50" align="center"><strong>Room No
                            <?php echo html_escape($room->roomno); ?></strong></p>
                </div>
                <?php $sl++; ?>
                <?php } ?>
                <?php } ?>
                <div>

                </div>

            </div>
        </div>

    </div>
</div>
<div id="printArea" class="d-none">
        <?php foreach ($roomlist as $room) { ?>
            <div class="room-back-padding"><img
                    src="https://chart.apis.google.com/chart?cht=qr&amp;chs=200x210&amp;chl=<?php echo html_escape($room->roomno); ?>&amp;chld=H|0"
                    alt="qr1" class="w-100">
                    <h2><p align="center" class="w-100"><strong>Room No
                        <?php echo html_escape($room->roomno); ?></strong></p></h2>
            </div>
        <?php } ?>
</div>