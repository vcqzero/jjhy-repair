<?php 
use App\Model\User;
use App\Model\RoleStatus;

$workers = User::query()->whereHas('roles_on_owning', function($query) {
    $query->where('name', 'WORKER')
    ->whereIn('role_user.status', [RoleStatus::WORKER_ENABLED, RoleStatus::WORKER_FORBIDDEN]);
})->get();
?>
<select
class="form-control"
name="worker_id"
>
	<option value="">全部</option>
	<?php foreach ($workers as $worker):?>
	<option value="<?=$worker->id?>"><?=$worker->realname?></option>
	<?php endforeach;?>
</select> 