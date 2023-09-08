<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
<?php
$usertype = $_settings->userdata('user_type'); 
$type = $_settings->userdata('id');
$level = $_settings->userdata('type');
$department = $_settings->userdata('department');
?>
<style>
	.nav-gr{
		background-color:#007bff;
		color:white!important;
		box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2), 0 1px 1px 0 rgba(0, 0, 0, 0.1);
    }
    .nav-gr:hover{
        background-color:#007bff!important;
        color:white!important;
        box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2), 0 1px 1px 0 rgba(0, 0, 0, 0.1)!important;
    }
    #declined-link{
		border-bottom: solid 2px blue;
        background-color:#E8E8E8;
	}
	.main_menu{
		float:left;
		width:227px;
		height:40px;
		line-height:40px;
		text-align:center;
		color:black!important;
		border-right:solid 3px white;
	}
	.main_menu:hover{
		border-bottom: solid 2px blue;
		background-color:#E8E8E8;
	}
    #container {
        display: flex;
        justify-content: center;
        align-items: center;
        background-color:transparent;
    }
</style>

<div class="card card-outline card-primary">
	<div class="card-body">
		<div class="container-fluid">
        <div class="container-fluid">
			<table class="table table-hover table-striped" style="text-align:center;">
				<thead>
					<tr class="bg-navy disabled">
						<th>#</th>
						<!-- <th>Locations</th>
                        <th>TimeCardID</th> -->
                        <th>ID</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Type</th>
					</tr>
				</thead>
                <tbody>
                <?php
$uniqueRows = array(); 
$qryExempted = $conn->query("SELECT c_idno, c_trandate, c_trantype, c_trantime
                             FROM tbl_attendance
                             WHERE c_trandate<='2023-08-20'
                             AND (c_idno, c_trandate, c_trantype) NOT IN (
                                 SELECT c_idno, c_trandate, c_trantype
                                 FROM tbl_attendance
                                 WHERE c_trandate>='2023-08-20'
                                 GROUP BY c_idno, c_trandate, c_trantype
                                 HAVING COUNT(*) > 1
                             )");
while ($rowExempted = $qryExempted->fetch_assoc()):
    $type = $rowExempted['c_trantype'];
    $id = $rowExempted['c_idno'];
    $date = $rowExempted['c_trandate'];
    $time = $rowExempted['c_trantime'];
    $uniqueIdentifier = $id . $date . $type;

    if (!in_array($uniqueIdentifier, $uniqueRows)) {
        $uniqueRows[] = $uniqueIdentifier; 

        ?>
        <tr>
            <td class="text-center"><?php echo $i++; ?></td>
            <td class=""><?php echo $id ?></td>
            <td class=""><?php echo $date ?></td>
            <td class=""><?php echo $time ?></td>
            <td class=""><?php echo $type ?></td>
        </tr>
        <?php
    }
endwhile;
$i = 1; 
$qry = $conn->query("SELECT mt.c_idno, mt.c_trandate, mt.c_trantype, MAX(mt.c_trantime) AS max_trantime, MIN(mt.c_trantime) AS min_trantime
                     FROM tbl_attendance mt
                     JOIN (SELECT c_idno, c_trandate, c_trantype
                           FROM tbl_attendance
                           WHERE c_trandate>='2023-08-20'
                           GROUP BY c_idno, c_trandate, c_trantype
                           HAVING COUNT(*) > 1) subquery
                     ON mt.c_idno = subquery.c_idno AND mt.c_trandate = DATE(subquery.c_trandate) + INTERVAL '5 MINUTE'
                     GROUP BY mt.c_idno, mt.c_trandate, mt.c_trantype ASC");

                    while ($row2 = $qry->fetch_assoc()):
                        $type = $row2['c_trantype'];
                        $id = $row2['c_idno'];
                        $date = $row2['c_trandate'];
                        $time = $row2['min_trantime']; 
                        $uniqueIdentifier = $id . $date . $type;
                        if (!in_array($uniqueIdentifier, $uniqueRows)) {
                            $uniqueRows[] = $uniqueIdentifier; 
                    
                            ?>
                            <tr>
                                <td class="text-center"><?php echo $i++; ?></td>
                                <td class=""><?php echo $id ?></td>
                                <td class=""><?php echo $date ?></td>
                                <td class=""><?php echo $time ?></td>
                                <td class=""><?php echo $type ?></td>
                            </tr>
                            <?php
                        }
                    endwhile;
                    ?>

                </tbody>
			</table>
		</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(){
		$('.delete_data').click(function(){
			_conf("Are you sure to delete this Item permanently?","delete_item",[$(this).attr('data-id')])
		})
		$('#create_new').click(function(){
			uni_modal("<i class='fa fa-plus'></i> Create New Item","po/items/manage_item.php")
		})
		$('.view_data').click(function(){
			uni_modal("<i class='fa fa-info-circle'></i> Item's Details","po/items/view_details.php?id="+$(this).attr('data-id'),"")
		})
		$('.edit_data').click(function(){
			uni_modal("<i class='fa fa-edit'></i> Edit Item's Details","po/items/manage_item.php?id="+$(this).attr('data-id'))
		})
		$('.table th,.table td').addClass('px-1 py-0 align-middle')
		$('.table').dataTable();
	})
	function delete_item($id){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=delete_item",
			method:"POST",
			data:{id: $id},
			dataType:"json",
			error:err=>{
				console.log(err)
				alert_toast("An error occured.",'error');
				end_loader();
			},
			success:function(resp){
				if(typeof resp== 'object' && resp.status == 'success'){
					location.reload();
				}else{
					alert_toast("An error occured.",'error');
					end_loader();
				}
			}
		})
	}
</script>