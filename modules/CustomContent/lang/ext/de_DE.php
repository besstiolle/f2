<?php
$lang['error_nofeusers'] = 'Fehler: Konnte kein installiertes FrontEndUsers-Modul finden';
$lang['friendlyname'] = 'CustomContent-Modul';
$lang['postinstall'] = ' ';
$lang['postuninstall'] = ' ';
$lang['uninstalled'] = 'Modul deinstalliert.';
$lang['installed'] = 'Modulversion %s installiert.';
$lang['accessdenied'] = 'Zugriff verweigert. Bitte pr&uuml;fen Sie Ihre Berechtigungen.';
$lang['error'] = 'Fehler!';
$lang['upgraded'] = 'Modul auf Version %s aktualisiert.';
$lang['moddescription'] = 'Mit diesem Modul k&ouml;nnen Sie in Abh&auml;ngigkeit der Gruppenzugeh&ouml;rigkeit oder des Benutzernamens verschiedene Inhalte auf Ihrer Homepage anzeigen lassen.';
$lang['help'] = '<h3>Was macht dieses Modul?</h3>
<p>Dieses Modul erm&ouml;glicht es, in Verbindung mit dem FrontendUsers-Modul eine Seite zu erstellen, deren Inhalt von der Person abh&auml;ngig ist, die sie betrachtet. So k&ouml;nnen Sie f&uuml;r bestimmte Benutzer oder Mitglieder bestimmter Gruppen unterschiedliche Inhalte festlegen.</p>
<p><strong>Hinweis 1:</strong> Wenn Sie die Smarty-Logik im Inhalt einer Seite einf&uuml;gen, sollten Sie darauf achten, dass beim Speichern dieser Seite der Parameter &bdquo;Zwischenspeichern&ldquo; (Reiter Optionen) nicht aktiviert ist.</p>
<p><strong>Hinweis 2:</strong> Wenn Sie die Smarty-Logik in Ihrem Template einsetzen, sollten Sie darauf achten, dass f&uuml;r jede Seite, die dieses Template verwendet, der Parameter &quot;Zwischenspeichern&quot; deaktiviert ist.</p>
<h3>Wie wird es eingesetzt?</h3>
<p>Plazieren Sie die Inhalte, die den Besuchern in Abh&auml;ngigkeit ihres Status (Anmeldung, Gruppenzugeh&ouml;rigkeit etc.) angezeigt werden sollen:</p>
<pre>
<code>
{if $ccuser->loggedin()}
  Willkommen {$customcontent_loginname}
{else}
  Sie sind nicht authorisiert, diese Daten zu sehen.
{/if}
</code>
</pre>
<p>Oder Sie verwenden die $ccuser-Variable f&uuml;r erweiterte und einfacher zu lesende Abfragen:</p>
<pre>
<code>
{if $ccuser->loggedin() &amp;&amp; $ccuser->memberof(&#039;members&#039;) &amp;&amp; $ccuser->ipmatches(&#039;192.168.0.0/24&#039;)}
   Willkommen, angemeldetes lokales Mitglied
{elseif $ccuser->loggedin() &amp;&amp; $ccuser->memberof(&#039;members&#039;)}
   Willkommen, angemeldetes Mitglied
{elseif $ccuser->loggedin()}
   Willkommen, Benutzer einer anderen Gruppe
{else}
   Anonymer Benutzer
{/if}
</code>
</pre>
<h4>Verf&uuml;gbare Variablen:</h4>
<table>
	<tbody>
	<tr>
		<th rowspan=&quot;7&quot; scope=&quot;rowgroup&quot; style=&quot;vertical-align: top;&quot;>ccuser</th>
		<td colspan=&quot;2&quot;>Ein Objekt mit komfortablen Funktionen zum Testen.<br />Dieses Objekt enth&auml;lt einige komfortable Methoden, um eine erweiterte CustomContent-Logik zu verwenden oder Ihr Template etwas besser aussehen zu lassen. Die verf&uuml;gbaren Methoden sind folgende:</p>
	  <ul>
	<tr>
		<th scope=&quot;row&quot;>$ccuser->groups()</th>
		<td>gibt eine Liste aller Gruppenmitglieder aus
	</tr>
	<tr>
		<th scope=&quot;row&quot;>$ccuser->memberof(&#039;group&#039;)</th>
		<td>gibt eine Variable vom Typ Boolean aus, wenn der Benutzer Mitglied dieser Gruppe ist. Diese Funktion akzeptiert auch eine mit Kommata getrennte Liste von Gruppennamen.
	</tr>
	<tr>
		<th scope=&quot;row&quot;>$ccuser->loggedin()</th>
		<td>gibt eine Variable vom Typ Boolean aus, wenn der Benutzer angemeldet ist
	</tr>
	<tr>
		<th scope=&quot;row&quot;>$ccuser->username()</th>
		<td>gibt die Benutzernamen aller aktuell angemeldeten Benutzer aus
	</tr>
	<tr>
		<th scope=&quot;row&quot;>$ccuser->property(&#039;propertyname&#039;)</th>
		<td>gibt den Wert der Eigenschaft f&uuml;r den aktuell angemeldeten Benutzer aus.
	</tr>
	<tr>
		<th scope=&quot;row&quot;>$ccuser->ipmatches($ranges)</th>
		<td>gibt eine Variable vom Typ Boolean aus, wenn die IP des Benutzers mit einem Wert einer vorgegebenen (durch Kommata zu trennenden) IP-Liste &uuml;bereinstimmt.  Es werden Werte im Format ###.###.###.###/## akzeptiert, z. Bsp: 192.168.0.0/24
	</tr>
	</tbody>
	<tbody>
		<tr>
			<th scope=&quot;row&quot;>customcontent_ip</th>
			<td>die Remote-IP-Adresse</td>
		</tr>
		<tr>
			<th scope=&quot;row&quot;>customcontent_loggedin</th>
			<td>eine Integer-Variable, die die Benutzer-ID des aktuell angemeldeten Benutzers enth&auml;lt. Diese Variable kann existieren, aber ohne Wert sein, wenn der Benutzer nicht angemeldet ist.</td>
		</tr>
		<tr>
			<th scope=&quot;row&quot;>customcontent_loginname</th>
			<td>der Name des aktuell angemeldeten Benutzers</td>
		</tr>
		<tr>
			<th scope=&quot;row&quot;>customcontent_groupcount</th>
			<td>ein Z&auml;hler f&uuml;r die Anzahl der Gruppen, in denen dieser Benutzer Mitglied ist</p></tr>
		<tr>
			<th scope=&quot;row&quot;>customcontent_groups</th>
			<td>ein String, der die Gruppennamen aller Gruppen enth&auml;lt</p></tr>
		<tr>
			<th scope=&quot;row&quot;>customcontent_memberof_*</th>
			<td>eine Reihe von Variablen vom Typ &bdquo;Boolean&ldquo;, die eine Gruppenmitgliedschaft festlegt. z.&nbsp;B.: <code>customcontent_memberof_staff</code>, <code>customcontent_memberof_users</code>, usw. Sind keine Variablen f&uuml;r die Gruppen definiert, bedeutet das, dass der Benutzer kein Mitglied einer der Gruppen ist.</td>
		</tr>
	</tbody>
</table>
<h3>Copyright und Lizenz</h3>
<p>Copyright &copy; 2009, Robert Campbell (<a href="mailto:calguy1000@cmsmadesimple.org">calguy1000@cmsmadesimple.org</a>). Alle Rechte vorbehalten.</p>
<p>Dieses Modul wurde unter der <a href="http://www.gnu.org/licenses/licenses.html#GPL">GNU General Public License</a> ver&ouml;ffentlicht. Sie m&uuml;ssen dieser Lizenz zustimmen, bevor sie das Modul verwenden.</p>
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
Or read it <a href="http://www.gnu.org/licenses/licenses.html#GPL">online</a></p>';
?>