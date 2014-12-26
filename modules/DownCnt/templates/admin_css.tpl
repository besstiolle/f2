{literal}
<style type="text/css">
.sortable{
cursor: pointer;
border: 1px solid transparent;
}
.sortable:hover{
border: 1px solid #999;
}

.tag, .tag2{
    background-color: #DDDDDD;
    border: 1px solid #999999;
    display: inline-block;
    height: 16px;
    margin: 1px 2px;
    padding: 0 7px;
	cursor: pointer;
	background:url({/literal}{$root_url}{literal}/modules/DownCnt/img/close.gif) no-repeat scroll 4px 4px #DDDDDD;
    padding-left: 17px;
}


.sortable span{
    background-image: url("{/literal}{$root_url}{literal}/modules/DownCnt/js/bg.gif");
    background-position: right center;
    background-repeat: no-repeat;
	height:9px;
	width:21px;
	display:inline-block;
}
.headerSortUp span{
	background-image: url("{/literal}{$root_url}{literal}/modules/DownCnt/js/asc.gif");
}
.headerSortDown span{
	background-image: url("{/literal}{$root_url}{literal}/modules/DownCnt/js/desc.gif");
}

.pagetable tbody tr:nth-child(even) {background: #E5E5E5;}
.pagetable tbody tr:nth-child(odd) {background: #FFF;}
.pagetable tbody tr:hover {background: #CCC;}

.w20{
	width:20%;
}

.w30{
	width:30%;
}


div.sectionwrapper{
    background-color: #F0F0F0;
    border: 1px solid #D7D7D7;
    border-radius: 15px 15px 15px 15px;
    margin-bottom: 10px;
    padding: 0 10px 5px;
}
h3.section{
	cursor: pointer;
}

#{/literal}{$id}{literal}newtag{
}

#newtag{
	cursor: pointer;
}

/**************************/

#statsWrapper{
}

#statsOptionsBox{
    float: left;
    width: 320px;
	text-align: center;
}

#statsCodeBox{
    background-color: #F0F0F0;
    border-radius: 5px 5px 5px 5px;
    box-shadow: -1px -1px 2px #000000;
    font-family: monospace;
    margin-bottom: 5px;
    margin-left: 340px;
    padding-left: 5px;
}

#statsRenderBox{
    
    margin-left: 340px;
    min-height: 300px;
}

#slider-range{
	width:90%;
	margin: 0 auto 10px;
}

#amount{
	width:200px;
	margin-bottom: 15px;
}

div.radio, div.radio2{
	background: none repeat scroll 0 0 #EEEEEE;
    border-radius: 5px 5px 5px 5px;
    margin: 5px auto;
    padding: 5px;
	border: 1px solid #D0D0D0;
}
span.label{
	color: #333333;
    display: block;
    font-family: Verdana;
    font-size: 1.1em;
    font-weight: 600;
    margin-bottom: 9px;
    text-align: left;
    width: 100%;
}

ul#tag, ul#counter{
	margin: 0;
}

li.checkbox{
    float: left;
    max-height: 300px;
    overflow-x: hidden;
    padding: 0;
    text-align: left;
    width: 150px;
}

li.checkbox label{
    display: inline-block;
    line-height: 1em;
}

.error{
    background: url("{/literal}{$img_error}{literal}") no-repeat scroll 10px 50% #F2D4CE;
    border: 1px solid #AE432E;
    display: block;
    margin: 0;
    padding: 10px 10px 10px 45px;
}

.DCversion{
    color: #CCCCCC;
    text-align: right;
}

</style>{/literal}