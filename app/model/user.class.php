<?php
class model_user extends components_basemodel{
	
	public function primarykey() {
		return 'user_id';
	}
	
	public function tableName() {
		return 'zw_users';
	}
}