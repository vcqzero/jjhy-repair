<?php 
use App\Model\Workyard;
use App\Model\WorkyardStatus;

$workyards = Workyard::query()
->whereIn('status', 
    [WorkyardStatus::STATUS_ENABLED, WorkyardStatus::STATUS_FORBIDDEN])
->get();
?>
<select
class="form-control"
name="workyard_id"
>
	<option value="">全部</option>
	<?php foreach ($workyards as $workyard):?>
	<option value="<?=$workyard->id?>"><?=$workyard->name?></option>
	<?php endforeach;?>
</select> 