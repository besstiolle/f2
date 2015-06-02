<?php


class WikiAccess extends OrmEntity {

	public function __construct() {
		parent::__construct('Forge2FrontOffice','WikiAccess');
		
		$this->add(new OrmField('accessId'	
			, OrmCAST::$INTEGER 
			, null	
			, null
			, OrmKEY::$PK	
		));
		
		$this->add(new OrmField('prefix'		
			, OrmCAST::$STRING
			, 255
			, TRUE	
		));
		
		$this->add(new OrmField('user'		
			, OrmCAST::$INTEGER
		));
		
		$this->add(new OrmField('r'		
			, OrmCAST::$INTEGER
			, 1	
		));
		$this->add(new OrmField('w'		
			, OrmCAST::$INTEGER
			, 1	
		));
		$this->add(new OrmField('d'		
			, OrmCAST::$INTEGER
			, 1	
		));

		$this->garnishAutoincrement();	

		$this->addIndexes(array('user'));
		$this->addIndexes(array('prefix'));

		$this->garnishDefaultValue('r',1);
		$this->garnishDefaultValue('w',0);
		$this->garnishDefaultValue('d',0);
		
	}	
}
?>