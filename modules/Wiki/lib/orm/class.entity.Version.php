<?php
/**
 * A very simple example of how you can define a "User" without any relation to another Object.
 */ 
class Version extends OrmEntity {

	public static $STATUS_OLD = 0;
	public static $STATUS_CURRENT = 1;
	public static $STATUS_DELETED = -1;

	public function __construct() {
		parent::__construct('Wiki','Version');
		
		$this->add(new OrmField('version_id'	
			, OrmCAST::$INTEGER 
			, null	
			, null
			, OrmKEY::$PK	
		));
		
		// the title = the url
		$this->add(new OrmField('title'
			, OrmCAST::$STRING
			, 255	
		));
		
		// the content
		$this->add(new OrmField('text'		
			, OrmCAST::$BUFFER 
		));
		
		// DateTime of Creation (a modification = a new creation)
		$this->add(new OrmField('dt_creation'
			, OrmCAST::$DATETIME
		));
		
		// Link to the original page to preserve the history
		$this->add(new OrmField('page'		
			, OrmCAST::$INTEGER
			, null	
			, null
			, OrmKEY::$FK
			, "Page.page_id"
		));
		
		// Link to the lang category to offer Multi-Lang edition
		$this->add(new OrmField('lang'		
			, OrmCAST::$INTEGER
			, null	
			, null
			, OrmKEY::$FK
			, "Lang.lang_id"
		));
		
		// Not required link to the author (integer or string or both)
		$this->add(new OrmField('author_name'
			, OrmCAST::$STRING
			, 255	
			, TRUE
		));
		$this->add(new OrmField('author_id'
			, OrmCAST::$INTEGER
			, null
			, TRUE
		));
		
		
		$this->add(new OrmField('status'
			, OrmCAST::$INTEGER
		));
		
		$this->garnishAutoincrement();
		
		$this->garnishDefaultValue('status',0);
		$this->addIndexes('status');
		
		$this->garnishDefaultOrderBy(new OrmOrderBy(array('version_id'=>OrmOrderBy::$DESC)));
	}	
}
?>