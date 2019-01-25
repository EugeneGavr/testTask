
<div class="row crd">
	<div class="col-sm-2"><b><h4>Card number: </b></div>
	<div class="col-sm-10"><h4><?php echo $cardinfo['number'];?></div>
</div>
<div class="row">
  	<div class="col-sm-2">
  		<b>Amount: </b>
  		<br><b>Current amount: </b>
  		<br><b>Status: </b>
  	</div>
  	<div class="col-sm-4">
  		<?php echo $cardinfo['series'];?>
  		<br><?php echo $cardinfo['sum'];?>
  		<br><div id="status"><?php echo $cardinfo['status'];?></div>
  	</div>
  	<div class="col-sm-2">
  		<b<b>Registration date: </b>
  		<br><b>Disactivation date: </b>
  		<br><b>Date of last usage: </b>
  	</div>
  	<div class="col-sm-1">
  		<?php echo $cardinfo['born_date'];?>
  		<br><?php echo $cardinfo['death_date'];?>
  		<br><?php echo $cardinfo['use_date'];?>
  	</div>
  	<div class="col-sm-3">
  		<form method="post">
  			<input class="btn btn-primary" type="submit"  id="activation" name="activation" value="<?if($cardinfo['status']=='active'){echo 'Deactivate';}else{echo 'Activate';}?>">
  			<input class="btn btn-danger" type="submit"  name="delete" value="Delete">
  			<input class="btn btn-primary" type="submit"  name="back" value="Back">
  		</form>
	</div>
</div>
<table class="table">
 	<thead class="thead-dark">
    	<tr>
		    <th scope="col">Status</th>
		    <th scope="col">Purchase price (UAH)</th>
		    <th scope="col">Number of removed bonuses</th>
		    <th scope="col">Purchase date</th>
    	</tr>
  	</thead>
	<tbody>
		<?php foreach ($cards as $val): ?>
			<tr>
	     		<td class='status'><? echo $val['status'];?></td>
	     		<td class='cost'><? echo $val['cost']?></td>
	     		<td class='removed_bonuses'><? echo $val['removed_bonuses']?></td>
	     		<td class='date'><? echo $val['date']?></td>
    		</tr>
		<?php endforeach?>
  	</tbody>
</table>