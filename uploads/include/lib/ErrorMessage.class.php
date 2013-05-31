<?php
if(!defined('ACCESS')) {exit('Access denied.');}
class ErrorMessage {
	const SUCCESS		= "操作成功";
	const ERROR = "操作失败，服务器异常";
	const NEED_PARAM	="缺少必填项";
	const HAVE_USER		="账号组被使用，不能删除；若要删除，请先将属于该组的用户划拨到其它账号组";
	const HAVE_FUNC		="该模块下有菜单被使用，不能删除；若要删除，请先将属于该模块的菜单及链接删除或划拨到其它模块下";
	const NAME_CONFLICT ="名称冲突";
	const CAN_NOT_DO_SELF="不能删除或者封停自己";
	const PWD_TOO_SHORT	="密码不能少于6位";
	const OLD_PWD_WRONG	="原密码错误";
	const VERIFY_CODE_WRONG ="验证码错误";
	const PWD_UPDATE_SUCCESS	="密码修改成功";
	const BE_PAUSED		="您被封停，请联系管理员！";
	const USER_OR_PWD_WRONG	="用户名或密码错误";
	const SUCCESS_NEED_LOGIN="操作成功，部分功能需要用户重新登录才可使用";
	const CAN_NOT_DELETE_SYSTEM_MENU ="系统菜单不能删除";
	const QUICKNOTE_NOT_OWNER ="不能修改或删除其他人提交的quick note.";
}
