<?php
if(!defined('ACCESS')) {exit('Access denied.');}

require( ADMIN_BASE_LIB. 'Smarty/Smarty.class.php' );

class Template{
	static private $mTemplate 	= null;
	static private $_instance	= null;
    
    /**
     * 实例化 
     * @return void
     */
	static function instance() {
		if(!is_object(self::$_instance)){
			self::$_instance = new Template;
        }
		return self::$_instance;
	}

    /**
     * 获取模版对象 
     * @return void
     */
	static private function getTemplate(){
		if ( null==self::$mTemplate ){
			$smarty = new Smarty();
			$smarty->setTemplateDir(TEMPLATE_DIR);
            //$smarty->template_dir = TEMPLATE_DIR;
			$smarty->setCompileDir(TEMPLATE_COMPILED);
            //$smarty->compile_dir = TEMPLATE_COMPILED;
			$smarty->setConfigDir(TEMPLATE_CONFIGS);
            //$smarty->config_dir = TEMPLATE_CONFIGS;
            $smarty->setCacheDir(TEMPLATE_CACHE);
			//$smarty->cache_dir = TEMPLATE_CACHE;
			$smarty->setPluginsDir(TEMPLATE_PLUGINS);
			//$smarty->plugins_dir = TEMPLATE_PLUGINS;

			$smarty->left_delimiter = '<{'; 
			$smarty->right_delimiter = '}>';
			self::$mTemplate = $smarty;
		}
		return self::$mTemplate;
	}

    /**
     *关闭对象 
     * @return void
     */
	static private function closeTemplate(){
		self::$mTemplate = null;
	}

    /**
     * 显示模版 
     * @param mixed $tpl_file 
     * @param array $v 
     * @param mixed $cache_id 
     * @return void
     */
	static public function display( $tpl_file,$v=array(), $cache_id=null ){
		if ( is_array($v) ) self::Assign($v);
		else $cache_id = $v;
		$smarty = self::getTemplate();
		//var_dump($smarty);
		$smarty->display( $tpl_file, $cache_id );
		self::closeTemplate();
	}
    
    /**
     * 向模版中赋值变量 
     * @param mixed $k 
     * @param mixed $v 
     * @return void
     */
	static public function assign($k=null, $v=null){
		$smarty = self::getTemplate();
		if ( $k && is_array($k) ) {
			foreach( $k AS $key=>$value )
				$smarty->assign($key, $value);
			return $smarty;
		}
		$smarty->assign($k, $v);
		return $smarty;
	}

    /**
     * 清空smarty对象 
     * @return void
     */
	static public function clear(){
		self::closeTemplate();
	}

}
