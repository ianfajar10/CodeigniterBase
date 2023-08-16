<div>
    <div class="pagetitle">
        <h4><?php echo $title ? $title : 'Dashboard' ?></h4>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url().'dashboard' ?>">Home</a></li>
                <li class="breadcrumb-item active"><?php echo $title ? $title : 'Dashboard' ?></li>
            </ol>
        </nav>
    </div>
</div>