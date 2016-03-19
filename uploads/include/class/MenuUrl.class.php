<?php
if (!defined('ACCESS')) exit('Access denied.');

class MenuUrl extends Base
{
	private static $table_name = 'menu_url';
	// 查询字段
	private static $columns = array('menu_id', 'menu_name', 'menu_url', 'module_id', 'is_show', 'online', 'shortcut_allowed', 'menu_desc', 'father_menu');
	const SESSION_NAME = 'osa_menuurl_list';

	public static function getTableName()
	{
		return parent::$table_prefix.self::$table_name;
	}

	public static function getMenuByRole($user_role, $online = 1)
	{
		$url_array = array();
		$db = self::__instance();

		$sql = "select * from " . self::getTableName() . " me," . Module::getTableName() . " mo where me.menu_id in ($user_role) and me.online = $online and me.module_id = mo.module_id and mo.online = 1";

		$list = $db->query($sql)->fetchAll();

		if ($list) {
			foreach ($list as $menu_info) {
				$url_array[] = $menu_info['menu_url'];
			}
			return $url_array;
		}
		return array();
	}

	public static function getMenuByUrl($url)
	{
		$url_array = array();
		$condition = array("menu_url" => $url);
		$db = self::__instance();
		$list = $db->select(self::getTableName(), self::$columns, $condition);
		if ($list) {
			$menu = $list[0];
			$module = Module::getModuleById($menu['module_id']);
			$menu['module_id'] = $module['module_id'];
			$menu['module_name'] = $module['module_name'];
			$menu['module_url'] = $module['module_url'];
			if ($menu['father_menu'] > 0) {
				$father_menu = self::getMenuById($menu['father_menu']);
				$menu['father_menu_url'] = $father_menu['menu_url'];
				$menu['father_menu_name'] = $father_menu['menu_name'];
			}
			return $menu;
		}
		return array();
	}

	public static function getListByModuleId($module_id, $type = "all")
	{
		if (!$module_id || !is_numeric($module_id)) {
			return array();
		}
		switch ($type) {
			case "sidebar":
				$sub_condition["is_show"] = 1;
				$sub_condition["online"] = 1;
				break;
			case "role":
				$sub_condition["online"] = 1;
				break;
			case "navibar":
				$sub_condition["is_show"] = 1;
				$sub_condition["online"] = 1;
				break;
			// default:
		}
		$sub_condition["module_id"] = $module_id;
		$condition = array("AND" => $sub_condition);
		$db = self::__instance();
		$list = $db->select(self::getTableName(), self::$columns, $condition);
		if ($list) return $list;
		return array();
	}

	public static function getFatherMenuForOptions()
	{
		$menu_options_array = array("0" => "无");
		$modules = Module::getAllModules();
		foreach ($modules as $module) {
			$list = self::getListByModuleId($module['module_id'], 'navibar');
			foreach ($list as $menu) {
				$menu_options_array[$module['module_name']][$menu['menu_id']] = $menu['menu_name'];
			}
		}
		return $menu_options_array;
	}

	public static function addMenu($function_data)
	{
		if (!$function_data || !is_array($function_data)) {
			return false;
		}
		$db = self::__instance();
		$id = $db->insert(self::getTableName(), $function_data);
		self::clearSession();
		return $id;
	}

	public static function getAllMenus($start = '', $page_size = '')
	{
		$db = self::__instance();
		$condition = array();
		if ($page_size) {
			$condition['LIMIT'] = array($start, $page_size);
		}
		$list = $db->select(self::getTableName(), self::$columns, $condition);
		$session_list = self::getSessionMenus();
		foreach ($list as &$menu) {
			if ($menu['father_menu'] > 0) {
				$menu['father_menu_name'] = $session_list[$menu['father_menu']]['menu_name'];
			}
		}
		if ($list) return $list;
		return array();
	}

	public static function clearSession()
	{
		unset($_SESSION[self::SESSION_NAME]);
	}

	public static function getSessionMenus()
	{
		if (array_key_exists(self::SESSION_NAME, $_SESSION)) {
			return $_SESSION[self::SESSION_NAME];
		} else {
			$db = self::__instance();
			$list = $db->select(self::getTableName(), self::$columns);
			$new_list = array();
			foreach ($list as $menu) {
				$new_list[$menu['menu_id']] = $menu;
			}
			foreach ($new_list as $menu_id => &$menu) {
				if ($menu['father_menu'] > 0) {
					$menu['father_menu_name'] = $new_list[$menu['father_menu']]['menu_name'];
				}
			}
			if ($new_list) {
				$_SESSION[self::SESSION_NAME] = $new_list;
			}
			return $new_list;
		}
	}

	public static function search($module_id, $menu_name, $start, $page_size)
	{
		$db = self::__instance();
		$limit = "";
		$where = "";
		if ($page_size) $limit = " limit $start,$page_size ";
		if ($module_id > 0 && $menu_name != "") {
			$where = " where me.module_id=$module_id and me.menu_name like '%$menu_name%'";
		} else {
			if ($module_id > 0) $where = " where me.module_id=$module_id ";
			if ($menu_name != "") $where = " where me.menu_name like '%$menu_name%' ";
		}

		$sql = "select * ,coalesce(mo.module_name, '已删除') from " . self::getTableName() . " me left join " . Module::getTableName() . " mo on me.module_id = mo.module_id $where order by me.module_id,me.menu_id $limit";
		$list = $db->query($sql)->fetchAll();
		$session_list = self::getSessionMenus();

		foreach ($list as &$menu) {
			if ($menu['father_menu'] > 0) {
				$menu['father_menu_name'] = $session_list[$menu['father_menu']]['menu_name'];
			}
		}
		if ($list) {
			return $list;
		}
		return array();
	}

	public static function count($condition = '')
	{
		$db = self::__instance();
		$num = $db->count(self::getTableName(), $condition);
		return $num;
	}

	public static function countSearch($module_id, $menu_name)
	{
		$db = self::__instance();
		$condition = array();
		if ($module_id > 0 && $menu_name != "") {
			$condition['module_id'] = $module_id;
			$condition['LIKE'] = array("menu_name" => $menu_name);
		} else {
			if ($module_id > 0) $condition['module_id'] = $module_id;
			if ($menu_name != "") $condition['LIKE'] = array("menu_name" => $menu_name);
		}
		$num = $db->count(self::getTableName(), $condition);
		return $num;
	}
	
	public static function delMenu($menu_id)
	{
		if (!$menu_id || !is_numeric($menu_id)) return false;
		$db = self::__instance();
		$condition = array("menu_id" => $menu_id);
		$result = $db->delete(self::getTableName(), $condition);
		return $result;
	}

	public static function getMenuById($menu_id)
	{
		if (!$menu_id || !is_numeric($menu_id)) return false;
		$db = self::__instance();
		$condition = array("menu_id" => $menu_id);
		$list = $db->select(self::getTableName(), self::$columns, $condition);
		if ($list) return $list[0];

		return array();
	}

	public static function getMenuByIds($menu_ids, $online = null, $shortcut_allowed = null)
	{
		$url_array = array();
		$privi = explode(',', $menu_ids);
		$sub_condition['menu_id'] = $privi;
		if (isset($online)) $sub_condition['online'] = $online;
		if (isset($shortcut_allowed)) $sub_condition['shortcut_allowed'] = $shortcut_allowed;

		$db = self::__instance();
		$list = $db->select(self::getTableName(), self::$columns, array("AND" => $sub_condition));
		if ($list) return $list;
		return array();
	}

	public static function updateMenuInfo($menu_id, $function_data)
	{
		if (!$function_data || !is_array($function_data)) return false;
		$db = self::__instance();
		$condition = array("menu_id" => $menu_id);
		$id = $db->update(self::getTableName(), $function_data, $condition);
		return $id;
	}

	/**
	 * 批量修改菜单，如批量修改所属模块
	 * menu_ids 可以为无 key 数组，也可以为 1, 2, 3 形式的字符串
	 */
	public static function batchUpdateMenus($menu_ids, $function_data) {

		if (!$function_data || !is_array($function_data)) return false;
		if (!is_array($menu_ids)) $menu_ids = explode(',', $menu_ids);
		$db = self::__instance();
		$condition = array("menu_id" => $menu_ids);

		$id = $db->update(self::getTableName(), $function_data, $condition);
		return $id;
	}
}
