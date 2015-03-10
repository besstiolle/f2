<?php
$lang['error_nofeusers'] = 'Errore: Non trovo il modulo FrontEndUsers';
$lang['friendlyname'] = 'Modulo Custom Content';
$lang['postinstall'] = '';
$lang['postuninstall'] = '';
$lang['uninstalled'] = 'Modulo disinstallato.';
$lang['installed'] = 'Versione del modulo %s installata.';
$lang['accessdenied'] = 'Accesso negato. Si prega di controllare i permessi.';
$lang['error'] = 'Errore!';
$lang['upgraded'] = 'Modulo aggiornato alla versione %s.';
$lang['moddescription'] = 'Questo modulo provvede l&#039;abilit&agrave; di specificare contenuto differente per gruppo o nome utente';
$lang['help'] = '<h3>Che cosa fa?</h3>
<p>Questo modulo assieme al modulo UserID permette di creare una pagina che viene visualizzata differentemente a seconda della persona. Potete specificare un differente contenuto per utente o per membri di un certo gruppo.</p>
<p><b>Nota 1:</b> Quando mettete la sintassi smarty in ogni pagina, dovreste assicurarvi che le pagine non siano cached. Questo &egrave; effettuato assicurandosi che il campo &quot;cachable&quot; &egrave; vuoto</p>
<p><b>Note 2:</b>Se la sintassi smarty &egrave; nel Modello, dovete assicurarvi che ciascuna pagina che usa il Modello non &egrave; cachable</p>
<h3>Come usarlo</h3>
<pre>
{if $ccuser->loggedin()}
  Benvenuto <b>{$customcontent_loginname}</b><br />
{else}
  <h1>Non siete autorizzato a visualizzare questi dati</h1>
{/if}
</pre>
<p>O potete utilizzare la variabile $ccuser per un uso pi&ugrave; avanzato e di pi&ugrave; facile lettura e testing</p>
<pre>
{if $ccuser->memberof(&#039;members&#039;) &amp;&amp; $ccuser->ipmatches(&#039;192.168.0.0/24&#039;)}
Benvenuto nei membri locali
{elseif $ccuser->loggedin() &amp;&amp; $ccuser->memberof(&#039;members&#039;)}
Benvenuto nei membri
{elseif $ccuser->loggedin()}
Benvenuto utente di altri gruppi
{else}
Utente anonimo
{/if}
</pre>
<br />
<h4>Variabili utilizzabili:</h4>
<ul>
<li><p><em>ccuser</em> - An object with convenience functions for testing.</p>
<p>This object contains some convenience methods for performing more advanced customcontent logic, or for making your template look a little bit better. The available methods are:</p>
  <ul>
<li><em>$ccuser->groups()</em> - outputs a list of the users member groups</li>
<li><em>$ccuser->memberof(&#039;group&#039;)</em> - outputs a boolean if the user is indeed a member of this group.  This function will also accept a comma separated list of group names.</li>
<li><em>$ccuser->loggedin()</em> - outputs a boolean if the user is loggedin</li>
<li><em>$ccuser->username()</em> - outputs the username of the currently logged in user.</li>
<li><em>$ccuser->property(&#039;propertyname&#039;)</em> - outputs the value of the property for the currently logged in user.</li>
<li><em>$ccuser->ipmatches($ranges)</em> - outputs a boolean if the users ip address matches one of the comma separated ip ranges.  Accepts ranges like ###.###.###.###/## i.e: 192.168.0.0/24</li>
<li><em>$ccuser->expired()</em> - Returns a boolean indicating wether the user has expired or not.</li>
  </ul>
<br/>
</li>
<li><p><em>customcontent_ip</em> - L&#039;indirizzo IP remoto</p></li>
<li><p><em>customcontent_loggedin</em> - Un valore booleano (true/false) che indica se l&#039;utente &egrave; autenticato o meno</p></li>
<li><p><em>customcontent_loginname</em> - Il nome del corrente utente autenticato</p></li>
<li><p><em>customcontent_groupcount</em> - Un contatore del numero di gruppi a cui appartiene questo utente</p></li>
<li><p><em>customcontent_groups</em> - Una stringa contenente il nome di tutti i gruppi</p></li>
<li><p><em>customcontent_memberof_*</em> - Una serie di valori booleani indicanti l&#039;appartenenza al gruppo. p.e.: customcontent_memberof_staff, customcontent_memberof_users, etc. Nessuna variabile &egrave; definita per i gruppi a cui non appartiene l&#039;utente.</p></li>
</ul>
<h3>Copyright and License</h3>
<p>Copyright &amp;copy; 2009, Robert Campbel <a href="mailto:calguy1000@cmsmadesimple.org">&amp;lt;calguy1000@cmsmadesimple.org&amp;gt;</a>. All Rights Are Reserved.</p>
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
$lang['qca'] = 'P0-250679722-1271187168764';
?>