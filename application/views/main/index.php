<br>
<div class="row">
	<div class="crd col-sm-7">
		<input name="create" id="create" class="btn btn-primary" type="submit" value="Generate">		
	</div>
	<div class="crd col-sm-.5">
		<input name="sort" id="sort" class="btn btn-primary" type="submit" value="Sort">
	</div>
	<div class="crd col-sm-2">
		<select name="sort_field" id="sel_column" class="form-control">
			<option value="series">Series</option>
			<option value="number">Number</option>
			<option value="born_date">Register Date</option>
			<option value="death_date">Deactivtion Date</option>
			<option value="use_date">Date of last use</option>
			<option value="sum">Cost</option>
			<option value="status">Status</option>
		</select>
	</div>
	<div class="crd col-sm-3.5">
		<div id="search_field" class="input-group mb-1">
  			<input type="text" name="search_field" class="form-control" placeholder="..." aria-describedby="basic-addon2">
 			<div class="input-group-append">
				<input name="search" class="btn btn-primary" type="submit" value="Search">
			</div>
		</div>		
	</div>
</div>


<table class="table">
 	<thead class="thead-dark">
    	<tr>
	     	<th scope="col">Series</th>
		    <th scope="col">Number</th>
		    <th scope="col">Register date</th>
		    <th scope="col">Deactivtion date</th>
		    <th scope="col">Date of last use</th>
		    <th scope="col">Amount (UAH)</th>
		    <th scope="col">Status</th>
		    <th scope="col"></th>
    	</tr>
  	</thead>
	<tbody>
		<?php foreach ($cards as $val): ?>
			<tr>
	     		<td class='series'><? echo $val['series']?></td>
	     		<td class='number'><? echo chunk_split($val['number'],4," ");?></td>
	     		<td class='date'><? echo $val['born_date']?></td>
	     		<td class='date'><? echo $val['death_date']?></td>
	     		<td class='date'><? echo $val['use_date']?></td>
	     		<td class='sum'><? echo $val['sum']?></td>
	     		<td class='status'><? echo $val['status']?></td>
	     		<td><input class="btn btn-primary" type="submit" name= <? echo $val['number']?> value="Open"></td>
    		</tr>
		<?php endforeach?>
  	</tbody>
</table>

