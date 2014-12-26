<?php
$lang['modulename'] = 'Compteur de T&eacute;l&eacute;chargement';
$lang['help'] = '<h3>Que fait ce module?</h3>
<p>Le module de compteur de t&eacute;l&eacute;chargement est un module tr&egrave;s simple d&#039;utilisation. Il est utilis&eacute; pour ajouter des compteurs aux fichiers pr&eacute;sents dans vos pages.
Ce module ne d&eacute;pend ni du module Uploads, ni d&#039;aucun autre module. Vous pouvez l&#039;utiliser pour n&#039;importe quel fichier, peu importe s&#039;il est pr&eacute;sent sur votre serveur ou non. Encore mieux : vous pouvez l&#039;utiliser pour <b>n&#039;importe quel lien</b> de votre site pointant vers votre site ou un autre site pour compter combien de fois il a &eacute;t&eacute; cliqu&eacute;!
</p>

<h3>Comment l&#039;utiliser?</h3>
<p>Le module Download counter est juste un module de type tag. Il est &agrave; ins&eacute;rer dans vos pages ou vos templates en utilisant le tag suivant :</p>


<p>
	<b>Pour g&eacute;n&eacute;rer l&#039;url dans la variable smarty &#039;counter_temp_id&#039; : </b>
	<code>{DownCnt name=&#039;counter_name&#039; link=&#039;www.mywebsite.com&#039; assign=&#039;counter_temp_id&#039;}</code>
</p>
<p>
	<b>Pour afficher l&#039;url dans vos page : </b>
	<code>{&amp;#36;counter_temp_id}</code>
</p>
<p>
	<b>Pour g&eacute;n&eacute;rer un lien HTML : </b>
	<code>&amp;lt;a href=&#039;{&amp;#36;counter_temp_id}&#039;&amp;gt;lot of text&amp;lt;/a&amp;gt;</code>
</p>
<p>
	<b>Pour afficher la valeur du compteur (nombre de clic). : </b>
	<code>(DownCnt name=&#039;counter_name&#039; action=&#039;display&#039;}</code>
</p>



<p>Soyez certain de d&eacute;finir les permissions &#039;Manage Download Counters&#039; aux utilisateurs qui administreront les compteurs.</p>


<h3>Param&egrave;tres</h3>
<ul>
<li><i>action</i> - action entreprise par le module. Les valeurs possibles sont :
  <ul>
    <li><i>default</i> - Le tag va g&eacute;n&eacute;rer un syst&egrave;me de comptage. Pour cela il va remplacer votre lien par un substitut dans le tag html &amp;lt;a&amp;gt; (par exemple: &amp;lt;a href=&quot;{DownCnt ...)&quot;; Les param&egrave;tres <i>name</i> et <i>link</i> sont obligatoires pour cette action;</li>
    <li><i>display</i> - Le tag va seulement afficher le compteur pour le nom donn&eacute;.; Le param&egrave;tre <i>name</i> est obligatoire.;</li>
  </ul>
<li><i>name</i> - Nom du compteur &agrave; utiliser. Le nom peut &ecirc;tre ce que vous souhaitez (le nom du fichier par exemple), mais, il devra &ecirc;tre unique sur l&#039;installation de CMS. Le nom est un identifiant qui permet de distinguer les diff&eacute;rents compteurs. Le nom ne peut pas &ecirc;tre plus grand que 255 caract&egrave;res.!</li>
<li><i>link</i> - Obligatoire uniquement si <i>action</i>=&#039;default&#039;; Ins&eacute;rez ici le lien vers la cible : le lien qui aurait &eacute;t&eacute; normalement utilis&eacute; dans la propri&eacute;t&eacute; href de la balise html &amp;lt;a&amp;gt; Le chemin est relatif au r&eacute;pertoire d&#039;installation de CMS. Pour des liens externes vous ne devez pas pr&eacute;ciser  <b>http://</b> mais vous devez ajouter le <b>param&egrave;tre protocol</b>.</li>
</ul>
<br/>
<p>Pour afficher le compteur derri&egrave;re un lien, le tag doit &ecirc;tre utilis&eacute; deux fois - une premi&egrave;re avec pour param&egrave;tre <i>action=</i>default  (le param&egrave;tre <i>action</i> peut m&ecirc;me &ecirc;tre ignor&eacute; dans ce cas pr&eacute;cis), et une seconde fois avec <i>action</i>=&#039;display&#039;. &Eacute;videment le m&ecirc;me param&egrave;tre <i>name</i> doit &ecirc;tre d&eacute;finit dans les deux tags.</p>

<h3>Exemples</h3>
<h4>Cr&eacute;ez un lien vers un site ou un fichier t&eacute;l&eacute;chargeable qui comptera les clics:</h4>
<p>Si vos liens ressemble &agrave;<br />
<br />

<br />
<code>
&amp;lt;a href=&#039;downloads/the_file.zip&#039;&amp;gt;download this file&amp;lt;/a&amp;gt;<br />
&amp;lt;a href=&#039;http://somesite.com&#039;&amp;gt;go to the site&amp;lt;/a&amp;gt;<br />
&amp;lt;a href=&#039;www.somesite.com/sub/contact.html&#039;&amp;gt;go to the site&amp;lt;/a&amp;gt;<br />
&amp;lt;a href=&#039;ftp://sub.somesite.com&#039;&amp;gt;see my ftp file&amp;lt;/a&amp;gt;</code><br />

<p>Pour faire des liens qui seront compt&eacute;, vous devez faire</p>

<code>
	{DownCnt name=&#039;the_file&#039; link=&#039;/downloads/the_file.zip&#039; assign=&#039;smarty_var1&#039;}<br />
	{DownCnt name=&#039;site_1&#039; link=&#039;http://somesite.com&#039; assign=&#039;smarty_var2&#039;}<br />
	{DownCnt name=&#039;site_2&#039; link=&#039;www.somesite.com/sub/contact.html&#039; assign=&#039;smarty_var3&#039;}<br />
	{DownCnt name=&#039;site_3&#039; link=&#039;ftp://sub.somesite.com&#039; assign=&#039;smarty_var4&#039;}<br />

	&amp;lt;a href=&#039;{&amp;#36;smarty_var1}&#039;&amp;gt;download this file&amp;lt;/a&amp;gt;<br />
	&amp;lt;a href=&#039;{&amp;#36;smarty_var2}&#039;&amp;gt;go to the site&amp;lt;/a&amp;gt;<br />
	&amp;lt;a href=&#039;{&amp;#36;smarty_var3}&#039;&amp;gt;go to the site&amp;lt;/a&amp;gt;<br />
	&amp;lt;a href=&#039;{&amp;#36;smarty_var4}&#039;&amp;gt;see my ftp file&amp;lt;/a&amp;gt;
</code>

<p>Notez que vous pouvez facilement utiliser votre WYSIWYG pour faire des liens, &eacute;crivez simplement {&amp;#36;var4} dans la case url<br/>
Les autres param&egrave;tres du tag html &amp;lt;a&amp;gt; , comme target ou class ou id peuvent &ecirc;tre utilis&eacute;s librement.</p>

<p>Since the version 2.3.0 you can create your counters in the back-office (it&#039;s harcoded links) and use them in your website like this : </p>

<code>
	{DownCnt sid=&#039;the_unique_name&#039; assign=&#039;another_smarty_var&#039;}<br />
	
	&amp;lt;a href=&#039;{&amp;#36;another_smarty_var}&#039;&amp;gt;download this file&amp;lt;/a&amp;gt;
</code>

<h4>Afficher le compteur de clic:</h4>
<p>Peut importe la nature du lien, qu&#039;il soit fait vers un site ou un fichier, il n&#039;y a qu&#039;une m&eacute;thode pour afficher le compteur. C&#039;est ainsi :<br />
<br />
<code>{DownCnt action=&#039;display&#039; name=&#039;the_file&#039;}</code><br />
<br />
Dans le param&egrave;tre <i>name</i> vous devez sp&eacute;cifier le m&ecirc;me nom utilis&eacute; pour la pr&eacute;c&eacute;dente d&eacute;claration du tag pour le lien.<br />
Ce tag affichera une valeur enti&egrave;re du compteur. Vous pouvez l&#039;entourer de n&#039;importe quel autre tag que vous souhaitez pour en alt&eacute;rer l&#039;apparence.<br />
Si le lien n&#039;a jamais &eacute;t&eacute; cliqu&eacute; (son compteur n&#039;existe donc pas encore) le tag affichera z&eacute;ro.</p>
<h4>Regroup your counters under Tags</h4>

<p>Since the version 2.2.0 you can create Tags. After that operation you will be allowed to regroup your counters under one or many Tags</p>
<p>The Tags system is used for the statistics</p>

<h4>Enjoy the statistics</h4>
<p>Since the version 2.3.0 you can generate statistics, just enjoy it. If you have question about it : send an email to bess : contact at furie.be</p>

<h3>La partie admin</h3>
<p>Vous pouvez g&eacute;rer les compteurs existant depuis la zone d&#039;administration de Cms MS. Allez dans le menu &quot;contenu&quot; et choisissez &quot;Download Counter&quot;.</p>
<p>Si vous souhaitez remettre &agrave; z&eacute;ro un compteur, supprimez le simplement. Il sera recr&eacute;&eacute; automatiquement la prochaine fois que le lien sera cliqu&eacute;.</p>
<p>L&#039;information <i>Active</i> informe si le compteur doit s&#039;incr&eacute;menter ou non. Si un compteur est d&eacute;sactiv&eacute; (non actif) le lien continuera de fonctionner et sa valeur sera toujours affich&eacute;. Il cessera juste de s&#039;incr&eacute;menter &agrave; chaque clic.</p>
';
$lang['changeLog'] = '<ul>
	<li>
		2.3.x 
		<ul>
			<li>ADD : You can create unique link in the backoffice and use them on the front-office like this : {DownCnt sid=&quot;mylink&quot;}</li>
			<li>ADD : You can see your statistics in the back-office</li>
			<li>FIX : bug with a fresh install 2.2.0</li>
		</ul>
	</li>
	<li>
		2.2.x 
		<ul>
			<li>ADD : Vous pouvez maintenant regrouper les compteurs par tags</li>
		</ul>
	</li>
	<li>
		2.1.x 
		<ul>
			<li>ADD : Nouveau Syst&egrave;me de s&eacute;curit&eacute; interne </li>
			<li>ADD : Tous les clics sont d&eacute;sormais sauvegard&eacute;s en base de donn&eacute;e pour des futures statistiques</li>
		</ul>
	</li>
	<li>
		2.0.0: nouvelle grosse version
		<ul>
			<li>SUPPRIME : le param&egrave;tre protocol</li>
			<li></li>
			<li>AJOUT: le param&egrave;tre assign qui permet de d&eacute;finir la valeur d&#039;une variable smarty avec l&#039;url g&eacute;n&eacute;r&eacute;e</li>
			<li>AJOUT: meilleur s&eacute;curit&eacute;</li>
			<li></li>
			<li>MAJ : mise &agrave; jour de la documentation</li>
		</ul>
	
	
	</li>
</ul>

';
$lang['description'] = 'Le module compteur de t&eacute;l&eacute;chargement vous permet de compter le nombre de clic sur un lien &agrave; partir de votre site.';
$lang['postinstall'] = 'Ne pas oubliez pas de vous assurer de mettre <b>la  permission &#039;Manage Download Counters&#039;</b> sur les utilisateurs qui g&eacute;reront les compteurs.<br />
Voir l&#039;aide pour plus information.';
$lang['pre_uninstall'] = 'Tous les compteurs seront supprim\u00E9s. \u00CAtes-vous s\u00FBr(e) de vouloir d\u00E9sinstaller ce module ?';
$lang['uninstalled'] = 'Module d&eacute;sinstall&eacute;.';
$lang['installed'] = 'Version %s du module version install&eacute;e.';
$lang['upgraded'] = 'Module mis &agrave; jour en version %s.';
$lang['nameunspec'] = 'Le param&egrave;tre n&eacute;cessaire name est ind&eacute;termin&eacute; !';
$lang['error_insufficientparams'] = 'Param&egrave;tre obligatoire non sp&eacute;cifi&eacute; : %s ';
$lang['nocountersfound'] = 'Il n&#039;y a pas encore ce compteur.<br />
Pour cr&eacute;er un compteur ajouter la balise module dans une page (voir l&#039;aide du module Pour plus d&#039;informations sur la fa&ccedil;on de le faire) - un nouveau compteur sera cr&eacute;&eacute; automatiquement quand quelqu&#039;un cliquera sur le lien pour la premi&egrave;re fois.';
$lang['noresult'] = 'Aucun r&eacute;sultat';
$lang['delete'] = 'Supprimer';
$lang['areyousure'] = 'Supprimer le compteur ?';
$lang['areyousure2'] = 'Supprimer les compteurs ?';
$lang['name'] = 'Nom du compteur';
$lang['link'] = 'Lien : url, fichier, autre';
$lang['newName'] = 'Nom (doit &ecirc;tre unique)';
$lang['newFile'] = 'Lien : url, fichier, autre';
$lang['lastdate'] = 'Derni&egrave;re date de click';
$lang['active'] = 'Actif';
$lang['tag'] = 'Tag';
$lang['withouttag'] = 'Sans tag';
$lang['addText'] = 'Ajouter un lien en dur';
$lang['usageText'] = 'Comment l&#039;utiliser ?';
$lang['submit'] = 'Envoyer';
$lang['listtagtext'] = 'Liste des tags';
$lang['confirm_del_tag'] = 'Etes-vous certain de vouloir supprimer ce tag';
$lang['title_hardlink'] = 'Liens en dur';
$lang['title_all'] = 'G&eacute;n&eacute;ral';
$lang['title_master'] = 'Par Tags';
$lang['title_stats'] = 'Statistiques';
$lang['delselected'] = 'Supprimer les compteurs s&eacute;lectionn&eacute;s';
$lang['needpermission'] = 'Vous avez besoin de la permission &#039;%s&#039; pour cette fonction.';
$lang['message_success'] = 'Op&eacute;ration termin&eacute;e avec succ&egrave;s';
$lang['error_no_id'] = 'Erreur interne : id non sp&eacute;cifi&eacute;e';
$lang['error_mustBeUnique'] = 'Le nom doit &ecirc;tre unique';
$lang['error_isrequired'] = 'Les deux champs sont obligatoires';
$lang['param_action'] = 'Action &agrave; effectuer dans la balise courante. \<i>default</i>&#039;: affiche des liens cliquable, &#039;<i>display</i>&#039;: affiche la valeur du compteur.';
$lang['param_name'] = 'Nom du compteur, par lequel les diff&eacute;rents compteurs serons distingu&eacute;s.';
$lang['param_link'] = 'Lien vers la ressource cible.';
$lang['chart_title'] = 'Graphs de %s &agrave; %s';
$lang['chart_x'] = 'Periode';
$lang['chart_y'] = 'Nombre de clics';
$lang['title_1'] = 'Choisissez le type de Graph';
$lang['title_2'] = 'Selectionnez la date min et le max';
$lang['title_3'] = 'Vous pouvez &eacute;galement choisir la derni&egrave;re date disponible ou exclure les robots des statistiques';
$lang['title_4'] = 'Regrouper sur diff&eacute;rentes p&eacute;riodes';
$lang['title_5'] = 'Regrouper les diff&eacute;rents compteurs (ou pas)';
$lang['generate'] = 'G&eacute;n&eacute;rer les Statistiques';
$lang['chart_line'] = 'Ligne';
$lang['chart_area'] = 'Aire';
$lang['chart_pie'] = 'Circulaire';
$lang['chart_from'] = 'de';
$lang['chart_to'] = '&agrave;';
$lang['chart_noEnd'] = 'Aucune Date de fin';
$lang['chart_bot'] = 'Eclure les robots';
$lang['chart_day'] = 'Jour';
$lang['chart_week'] = 'Semaine';
$lang['chart_month'] = 'Mois';
$lang['chart_year'] = 'Ann&eacute;e';
$lang['chart_24'] = '24-Heures glissantes';
$lang['chart_7'] = '7-jours glissants';
$lang['chart_bytag'] = 'Par tags';
$lang['chart_bytagD'] = 'Par tags + d&eacute;tails';
$lang['chart_bycounter'] = 'Tous les compteurs';
$lang['princess'] = 'D&eacute;sol&eacute; mario mais la princesse est dans un autre ch&acirc;teau (et de toute mani&egrave;re je n&#039;ai trouv&eacute; aucun r&eacute;sultat pour toi)';
$lang['utma'] = '156861353.1910303218.1345656156.1345658962.1345667388.3';
$lang['utmz'] = '156861353.1345656156.1.1.utmcsr=cmsmadesimple.fr|utmccn=(referral)|utmcmd=referral|utmcct=/';
$lang['utmc'] = '156861353';
$lang['utmb'] = '156861353';
?>