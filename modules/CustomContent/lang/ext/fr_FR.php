<?php
$lang['error_nofeusers'] = 'Erreur : le module FrontEndUsers n&#039;a pas &eacute;t&eacute; trouv&eacute;';
$lang['friendlyname'] = 'Contenu Personnalis&eacute;';
$lang['postinstall'] = ' ';
$lang['postuninstall'] = ' ';
$lang['uninstalled'] = 'Module d&eacute;sinstall&eacute;.';
$lang['installed'] = 'Version %s du module install&eacute;e.';
$lang['accessdenied'] = 'Acc&egrave;s refus&eacute;. Veuillez v&eacute;rifier vos permissions.';
$lang['error'] = 'Erreur !';
$lang['upgraded'] = 'Module mis &agrave; niveau &agrave; la version %s.';
$lang['moddescription'] = 'Ce module permet de sp&eacute;cifier un contenu diff&eacute;rent selon le groupe ou l&#039;utilisateur';
$lang['help'] = '<h3>Que fait ce module?</h3>
<p>Ce module, en association <strong>avec le module FrontEndUsers</strong> permet de cr&eacute;er une page diff&eacute;rente selon la personne qui la regarde. Vous pouvez sp&eacute;cifier un contenu diff&eacute;rent pour certains utilisateurs ou membres d&#039;un certain groupe.</p>
<p><b>Note 1 : </b>Une cr&eacute;ation logique dans une page pourrait potentiellement entra&icirc;ner un r&eacute;sultat diff&eacute;rent pour chaque demande, vous devez vous assurer que cette page ne sera pas mis en cache. V&eacute;rifier que le tag &quot;cachable&quot; est bien effac&eacute; sur la page avant de la valider et de la modifier</p>
<p><b>Note 2 : </b>Si vous mettez ces balises Smarty dans un gabarit, assurez vous que l&#039;ensemble des pages utilisant ce gabarit n&#039;est pas cachables que la page n&#039;est pas cachable. (d&eacute;selectionner dans l&#039;onglet options de la page)</p>
<p><b>Note 2 : </b>Si vous mettez ces balises Smarty dans un gabarit, assurez vous que l&#039;ensemble des pages utilisant ce gabarit n&#039;est pas cachable.</p>
<h3>Comment l&#039;utiliser</h3>
<p>Vous pouvez utiliser les variables du module</p>
<pre>
{if $ccuser->loggedin()}
<b>Bienvenue {$customcontent_loginname}</b>
{else}
<b>Vous n&#039;&ecirc;tes pas autoris&eacute; &agrave; regarder ce contenu</b>
{/if}
</pre>
<br/>
<p>Ou vous pouvez utiliser la variable $ccuser pour une utilisation avanc&eacute;s, et plus facile &agrave; tester</p>
<p>Variante : (nomgroupe est &agrave; remplacer par le nom d&#039;un groupe FrontEndUsers)</p>
<pre>
{if $customcontent_loggedin == &#039;1&#039; and $customcontent_memberof_nomgroupe and $customcontent_ip == &#039;127.0.0.1&#039;}
<b>Bienvenue {$customcontent_loginname} connect&eacute; avec IP : {$customcontent_ip}</b>
{elseif $customcontent_loggedin and $customcontent_memberof_nomgroupe}
<b>Bienvenue {$customcontent_loginname} du mon groupe {$customcontent_groups}</b>
{elseif $customcontent_loggedin}
<b>Bienvenue {$customcontent_loginname} du groupe {$customcontent_groups}</b>
{else}
<b>Bienvenue cher anonyme</b>
{/if}
</pre>
<p>Ou vous pouvez utiliser l&#039;objet $ccuser pour une utilisation plus avanc&eacute;e, avec des tests plus faciles</p>
<p><b>Note 3 :</b> Quand vous mettez ces balises Smarty dans une page, les symboles -> &amp;&amp; ne peuvent &ecirc;tre correctement interpr&eacute;t&eacute;s si la page est en mode WYSIWYG (&agrave; d&eacute;cocher)</p>
<pre>
{if $ccuser->memberof(&#039;members&#039;) &amp;&amp; $ccuser->ipmatches(&#039;192.168.0.0/24&#039;)}
<b>Bienvenue cher membre connect&eacute; en local</b>
{elseif $ccuser->memberof(&#039;members&#039;)}
<b>Bienvenue cher membre connect&eacute;</b>
{elseif $ccuser->loggedin()}
<b>Bienvenue cher utilisateur d&#039;un autre groupe</b>
{else}
<b>Bienvenue cher anonyme</b>
{/if}
</pre>
<p>Autre exemple : (Obtenir the root page alias)</p>
<pre>
{capture assign=&#039;rootalias&#039;}{$ccuser->get_root_alias()}{/capture}
</pre>
<p>Variante :</p>
{$ccuser->get_root_alias(&#039;&#039;,&#039;assign&#039;)}
<p>N&#039;importe quelles expressions logiques ou compatibles avec Smarty, peuvent &ecirc;tre utilis&eacute;es avec les variables disponibles. En utilisant cette syntaxe, les expressions peuvent &ecirc;tre imbriqu&eacute;es ou d&#039;une logique complexe.</p>
<h4>Variables disponibles</h4>
<ul>
<li><p><em>ccuser</em> - Un objet avec des fonctions pratiques pour vos tests et r&eacute;cup&eacute;rer les informations des visiteurs logu&eacute;s.</p>
<p>Cet objet contient des m&eacute;thodes pratiques pour r&eacute;aliser des balises smarty avanc&eacute;es sur l&#039;information du visiteur en cours.</p>
  <ul>
<li><em>$ccuser->get_parent_alias($alias,$assign)</em> - Retourne l&#039;alias de la page parent, ou vide si la page ne poss&egrave;de pas un parent (&agrave; la racine). Cette fonction accepte un alias de page comme argument, si aucun alias de page est pr&eacute;cis&eacute; ou vide, la page courante est s&eacute;lectionn&eacute;e. Si le param&egrave;tre attribu&eacute; n&#039;est pas vide, le r&eacute;sultat sera affect&eacute; &agrave; la variable smarty $assign pass&eacute;e en argument.</li>
<li><em>$ccuser->get_root_alias($alias,$assign)</em> - Retourne l&#039;alias de la page parent &agrave; la racine, ou vide si la page ne poss&egrave;de pas un parent (&agrave; la racine). Cette fonction accepte un alias de page (voir ci-dessus).</li>
<li><em>$ccuser->get_page_title($alias,$assign)</em> - Retourne le titre de la page contenant l&#039;alias fourni. Cette fonction accepte un alias de page (voir ci-dessus).</li>
<li><em>$ccuser->has_children($alias,$assign)</em> - Retourne un bool&eacute;en indiquant si la page a des pages enfants ou non. Cette fonction accepte un alias de page (voir ci-dessus).</li>
<li><em>$ccuser->groups()</em> - Retourne une liste des groupes d&#039;utilisateur</li>
<li><em>$ccuser->memberof(&#039;group&#039;)</em> - Retourne un bool&eacute;en si l&#039;utilisateur est en effet un membre de ce groupe. Cette fonction accepte aussi une virgule pour s&eacute;parer une liste de nom de groupe ou un tableau PHP de noms de groupes ou les ID.</li>
<li><em>$ccuser->loggedin()</em> - Retourne un bool&eacute;en si l&#039;utilisateur est connect&eacute;</li>
<li><em>$ccuser->username()</em> - Retourne le nom d&#039;utilisateur de l&#039;utilisateur connect&eacute;.</li>
<li><em>$ccuser->property(&#039;propertyname&#039;)</em> - Retourne la valeur de la propri&eacute;t&eacute; de l&#039;utilisateur connect&eacute;.</li>
<li><em>$ccuser->module_installed(&#039;modulename&#039;)</em> - Retourne un bool&eacute;en si le module sp&eacute;cifi&eacute; est install&eacute; et disponible.</li>
<li><em>$ccuser->ipmatches($ranges)</em> - Retourne un bool&eacute;en si l&#039;adresse IP de l&#039;utilisateur correspond &agrave; l&#039;une des plages d&#039;adresses IP de $ranges, s&eacute;par&eacute;es par des virgules, les plages d&#039;adresses IP.  Accepte comme plages IP ###.###.###.###/##  Exemple : 192.168.0.0/24</li>
<li><em>$ccuser->expired()</em> - Retourne une valeur bool&eacute;enne indiquant si l&#039;utilisateur a expir&eacute; ou non.</li>
  </ul>
<br/>
</li>
</ul>

<h3>Copyright et License</h3>
<p>Copyright &copy; 2009, Robert Campbell <a href="mailto:calguy1000@cmsmadesimple.org">mailto:calguy1000@cmsmadesimple.org</a>. Tous droits r&eacute;serv&eacute;s.</p>
<p>This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.</p>
<p>However, as a special exception to the GPL, this software is distributed
as an addon module to CMS Made Simple.  You may not use this software
in any Non GPL version of CMS Made simple, or in any version of CMS
Made simple that does not indicate clearly and obviously in its admin 
section that the site was built with CMS Made simple.</p>
<p>This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.
You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA
Or read it <a href="http://www.gnu.org/licenses/licenses.html#GPL">online</a></p>
';
?>