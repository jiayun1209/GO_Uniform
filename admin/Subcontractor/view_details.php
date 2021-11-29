<?php
require_once('../../config.php');
if (isset($_GET['subcontractor_ID']) && $_GET['subcontractor_ID'] != '') {
    $qry = $conn->query("SELECT * from `subcontractor` where subcontractor_ID = '{$_GET['subcontractor_ID']}' ");
    if ($qry->num_rows > 0) {
        foreach ($qry->fetch_assoc() as $k => $v) {
            $$k = stripslashes($v);
        }
    }
}
?>
<style>
    #uni_modal .modal-footer{
        display:none
    }
</style>
<div class="container fluid">
    <callout class="callout-primary">
        <dl class="row">
            <dt class="col-md-4">Subcontractor ID</dt>
            <dd class="col-md-8">: <?php echo $subcontractor_ID ?></dd>           
            <dt class="col-md-4">Subcontractor Name</dt>
            <dd class="col-md-8">: <?php echo $name ?></dd>
            <dt class="col-md-4">Email</dt>
            <dd class="col-md-8">: <?php echo $email ?></dd>
            <dt class="col-md-4">description</dt>
            <dd class="col-md-8">: <?php echo $description ?></dd>
            <dt class="col-md-4">Documents</dt>
            <dd class="col-md-8">: 
                <?php
                if (isset($subcontractor_ID)):
                    $subcontractor_qry1 = $conn->query("SELECT c.company_code, s.company_code, s.subcontractor_ID, f.title FROM `company` c, subcontractor s, companyfile f WHERE c.company_code = s.company_code and c.company_code = f.company_code and s.subcontractor_ID ='$subcontractor_ID'");
                    while ($row = $subcontractor_qry1->fetch_assoc()):
                        ?>   
                <li> <a href="../files/<?php echo $row['title']; ?>" target="_blank"><?php echo $row['title'] ?></a> </li>
                    
                    <?php
                endwhile;
            endif
            ?>                       
            </dd>
        </dl>
    </callout>
    <div class="row px-2 justify-content-end">
        <div class="col-1">
            <button class="btn btn-dark btn-flat btn-sm" type="button" data-dismiss="modal">Close</button>
        </div>
    </div>
</div>