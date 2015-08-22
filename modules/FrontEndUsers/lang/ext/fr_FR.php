<?php
$lang['prompt_enhancedpw'] = 'Exiger un mot de passe fort&nbsp;';
$lang['info_enhancedpw'] = 'Si activé, les mots de passe devront avoir au moins un caractère alphabétique, une majuscule et un chiffre.';
$lang['prompt_pwrequiredchars'] = 'Exiger un de ces caractères dans le mot de passe&nbsp;';
$lang['info_pwrequiredchars'] = 'Si les mots de passe non vides et forts sont activés, au moins l\'un des caractères spécifiés seront nécessaires dans le mot de passe en plus des exigences de mot de passe forts';
$lang['error_cantsetpropertytype'] = 'Vous ne pouvez pas définir la propriété de ce type';
$lang['info_import_format'] = '<p>For information on the import format you should create a sample user (or two) in the desired groups and export that information.  The resulting file can then be used as a template for further imports</p><br/>
 <p>Additionally, a txtpassword column can be added to the import file to define (in plain text) the password for users.  If the txtpassword column is empty for an existing user his password is not touched.  If this column is empty for a new user, or not provided at all the hardcoded password "changeme" is used.';
$lang['import_deleteduser'] = 'Utilisateur supprimé %s';
$lang['error_export_nousers'] = 'Aucun utilisateur trouvé à exporter';
$lang['prompt_export_users'] = 'Expoter les utlisateurs';
$lang['title_export_users'] = 'Exporter des utilisateurs dans un fichier ASCII';
$lang['info_encrypt'] = 'les propriétés cryptées ne peuvent pas être exportés en ASCII ou consultées par un administrateur. Ils ne peuvent être modifiés par l\'utilisateur autorisé.';
$lang['error_importgroupname'] = 'Nom de groupe spécifié invalide ou vide';
$lang['error_import_columncount'] = 'Nombre de colonnes incorrect';
$lang['prompt_delimiter'] = 'Delimiteur';
$lang['error_createtmpfile'] = 'Problème de création du fichier temporaire';
$lang['prompt_delete_users'] = 'Supprimer des utilisateurs supplémentaires';
$lang['info_import_delete_users'] = 'If enabled, and only <strong>one user group</strong> is mentioned in the import file, users that are members of that user group but not mentioned in the import file, will be deleted.  Caution should be used here, as no checks are done to see if the deleted users are members of any other groups.';
$lang['title_import_users'] = 'Importer des utilisateurs à partir d\'un fichier de type CSV';
$lang['frontend_access'] = 'Viewers';
$lang['error_lostun_nocontrols'] = 'Impossible d\'afficher le formulaire de récupération des détails d\'identifiant afficher le dernier nom d\'utilisateur... pas de champs appropriés trouvé pour afficher';
$lang['info_filter_sortby'] = '<strong> Note: </strong> Le tri des colonnes fournira un tri supplémentaire sur les éléments correspondants';
$lang['any'] = 'Aucun';
$lang['sortby_username_asc'] = 'Nom d\'utilisateur (ascendant)';
$lang['sortby_username_desc'] = 'Nom d\'utilisateur (descendant)';
$lang['sortby_create_asc'] = 'Date d\'expiration (ascendant)';
$lang['sortby_create_desc'] = 'Date d\'expiration (descendant)';
$lang['sortby_expires_asc'] = 'Date d\'expiration (ascendant)';
$lang['sortby_expires_desc'] = 'Date d\'expiration (descendant)';
$lang['info_encrypted'] = 'Les propriétés cryptées ne peuvent être vus et édités que par l\'utilisateur. Pas même l\'administrateur du site peut voir ou gérer ces données.';
$lang['encrypted'] = 'Crypté';
$lang['info_cookiename'] = 'Si coché, la fonctionnalité "se souvenir de moi" est activée. Ceci est similaire à la fonctionnalité keep-alive du cookie, mais peut durer jusqu\'à 60 jours.';
$lang['msg_username_readonly'] = 'L\'authentification de l’utilisateur ne permet pas de changer le nom d\'utilisateur de ce compte';
$lang['msg_password_readonly'] = 'L\'authentification de l’utilisateur ne permet pas de changer le mot de passe de ce compte';
$lang['prompt_normallogin'] = 'Login direct ';
$lang['move_up'] = 'Déplacer vers le haut';
$lang['move_down'] = 'Déplacer vers le bas';
$lang['title_propmodule'] = 'Cette propriété est créé par un module, et ne peut pas être modifiée';
$lang['not_available'] = 'Non disponible';
$lang['prompt_dflt_checked'] = 'Par défaut, ce champ doit être coché';
$lang['operation_completed'] = 'Operation complétée';
$lang['members'] = 'Membres';
$lang['view_filter'] = 'Voir les filtres';
$lang['data'] = 'Données';
$lang['applied'] = 'Appliqué';
$lang['firstpage'] = '<<';
$lang['prevpage'] = '<';
$lang['nextpage'] = '>';
$lang['lastpage'] = '>>';
$lang['page'] = 'Page ';
$lang['prompt_allow_changeusername'] = 'Autoriser le changement d\'identifiant par les membres&nbsp;';
$lang['info_allow_changeusername'] = 'Si cela est autorisé, les utilisateurs pourront modifier leur identifiant en même temps quel leurs autres paramètres';
$lang['template_saved'] = 'Gabarit enregistré';
$lang['template_resetdefaults'] = 'Gabarit réinitialisé';
$lang['lbl_settings'] = 'Réglages';
$lang['lbl_templates'] = 'Gabarits';
$lang['enable_captcha'] = 'Activer le captcha sur le formulaire de connexion';
$lang['info_enable_captcha'] = 'If the user is not logged in, and the module preference states to display the login form, this option controls wether a captcha will be displayed on the login screen.  If captcha is available';
$lang['pagetype_unauthorized'] = 'Vous n\'êtes pas autorisé(e) à accéder à ce contenu';
$lang['info_contentpage_grouplist'] = 'Spécifiez la liste des groupes du FEU qui auront accès à cette page. Si vous ne spécifiez aucun groupe, tout utilisateur connnecté pourra voir cette page';
$lang['pagetype_settings'] = 'Réglages des pages protégées';
$lang['pagetype_groups'] = 'Groupes autorisés&nbsp;';
$lang['info_pagetype_groups'] = 'Sélectionnez les groupes qui pourront (par défaut) voir les pages protégées. Un éditeur avec la permission "Manage All Content" pourra surpasser cette permission pour chaque page.';
$lang['pagetype_action'] = 'Action pour un accès non-autorisé&nbsp;';
$lang['info_pagetype_action'] = 'Spécifiez le comportement du module pour les personnes qui accèdent à cette page et qui ne requèrent pas les droits suffisants pour y accèder. Vous pouvez soit rediriger vers une page spécifique, soit affiche le formulaire de connexion.';
$lang['showloginform'] = 'Afficher le formulaire de connexion';
$lang['redirect'] = 'Rediriger vers une page';
$lang['pagetype_redirectto'] = 'Rediriger vers&nbsp;';
$lang['info_pagetype_redirectto'] = 'Choisissez la page vers laquelle rediriger.  Si vous n\'en choisissez pas, alors que l\'action est "rediriger", le visiteur se verra présenter un message lui indiquant qu\'il n\'a pas accès à la page.';
$lang['permissions'] = 'Permissions ';
$lang['feu_protected_page'] = 'Contenu protégé';
$lang['prompt_viewprops'] = 'Choisissez une propriété complémentaire à afficher';
$lang['view'] = 'Vue';
$lang['info_ignore_userid'] = 'If checked the import routine will attempt to add users independant of the userid column.  If a user with the name specified in the import file already exists, an error will be generated';
$lang['ignore_userid'] = 'Ignore la colonne UserID lors de l\'importation';
$lang['export_passhash'] = 'Exporter le hach du mot de passe pour le fichier';
$lang['info_export_passhash'] = 'Le hachage du mot de passe n\' est utile que si le salage du mot de passe sur l\'importation est identique à celui de l\'exportation';
$lang['error_adjustsalt'] = 'Le salage de mot de passe ne peut être réglé';
$lang['prompt_pwsalt'] = 'Salage du pot de passe&nbsp;';
$lang['info_pwsalt'] = 'FrontEndUsers utilise le salage de tous les mots de passe avec cette clé, qui est créé lors de l\'installation. Une fois que les utilisateurs ont été ajoutés à la base de données ce code ne peut être modifié. cette clé peut être vide pour les anciennes installations.';
$lang['advanced_settings'] = 'Réglages avancés';
$lang['info_sessiontimeout'] = 'Spécifier le nombre de secondes avant qu\'un utilisateur inactif soir déconnecté automatiquement du site';
$lang['prompt_expireusers_interval'] = 'Intervalle pour l\'expiration d\'un utilisateur&nbsp;';
$lang['info_expireusers_interval'] = 'Specify a value (in seconds) that indicates how often the system should force users whos session has expired to be logged out.  T"his is an optimization to save database queries.  If left empty or set to 0 expiry will be performed on every request.';
$lang['msg_settingschanged'] = 'Vos réglages ont été mis à jour avec succès';
$lang['forcedlogouttask_desc'] = 'Oblige les utilisateurs à se déconnecter à des intervalles de temps réguliers';
$lang['prompt_forcelogout_times'] = 'Temps pour la deconnexion forcée&nbsp;';
$lang['info_forcelogout_times'] = 'Specify a comma separated list of times like HH:MM,HH:MM where users will be forcibly logged out. Note, this uses the psuedocron mechanism so you must be sure that the times entered here will coincide reasonably with your "pseudocron granularity" and that sufficient requests will occur to your website to ensure that pseudocron is executed.';
$lang['prompt_forcelogout_sessionage'] = 'Exclure les membres qui n\'ont pas été actifs en <em>(minutes)</em>';
$lang['info_forcelogout_sessionage'] = 'If specified, any users that have been active in this number of seconds will not be forcibly logged out';
$lang['areyousure_delete'] = 'Etes vous sûr(e) de vouloir supprimer l\'utilisateur : %s';
$lang['error_invalidfileextension'] = 'Le type de fichier uploadé ne semble pas faire partie des fichiers autorisés';
$lang['postuninstall'] = 'Toutes les données associées au module FrontEndUsers ont été effacées';
$lang['info_ecomm_paidregistration'] = 'Si activé, ce module va écouter les événements de la suite Ecommerce.
Dans ce cas, les paramètres suivants sont effectifs.';
$lang['prompt_ecomm_paidregistration'] = 'Ecouter les événements des commandes';
$lang['info_paidreg_settings'] = 'Les paramètres suivants ne s\'appliquent que si vous utilisez le module Self Registration permettant des enregistrement payant';
$lang['none'] = 'Aucun';
$lang['delete_user'] = 'Supprimer l\'utilisateur';
$lang['expire_user'] = 'Expirez utilisateur';
$lang['prompt_action_ordercancelled'] = 'Action à effectuer quand un ordre de souscription est annulée';
$lang['prompt_action_orderdeleted'] = 'Action à effectuer quand un ordre de souscription est supprimé';
$lang['ecommerce_settings'] = 'Paramètres Ecommerce';
$lang['securefieldmarker'] = 'Marker sécurisé&nbsp;';
$lang['securefieldcolor'] = 'Champ coloré sécurisé&nbsp;';
$lang['prompt_encrypt'] = 'Stocker ces données de manière cryptée dans la base de données';
$lang['error_notsupported'] = 'L\'option choisie n\'est pas supportée avec la configuration actuelle';
$lang['audit_user_created'] = 'Utilisateur créé automatiquement';
$lang['info_auto_create_unknown'] = 'Si un utilisateur est authentifié par un module externe d\'authentification, mais est inconnu dans le module FrontEndUsers, un compte FEU doit-il être créé automatiquement ?';
$lang['prompt_auto_create_unknown'] = 'Créér automatiquement les utilisateurs inconnus&nbsp;';
$lang['display_settings'] = 'Afficher les réglages';
$lang['info_std_auth_settings'] = 'Les réglages suivants ne sont applicables qu\'avec "l\'Authentification intégrée".';
$lang['info_support_lostun'] = 'Choisir Non désactive la possibilité pour un utilisateur d\'utiliser la fonction de récupération des identifiants, indépendamment des autres réglages';
$lang['info_support_lostpw'] = 'Choisir Non désactive la possibilité pour un utilisateur de réinitialiser son mot de passe, indépendamment des autres réglages';
$lang['prompt_support_lostun'] = 'Autoriser les utilisateurs à demander leur identifiant&nbsp;';
$lang['prompt_support_lostpw'] = 'Autoriser les utilisateurs à demander un changement de mot de passe&nbsp;';
$lang['auth_settings'] = 'Paramétres d\'authentification';
$lang['authentication'] = 'Authentification intégrée';
$lang['auth_builtin'] = 'Authentification Standard de FEU';
$lang['auth_module'] = 'Module/Méthode d\'authentification&nbsp;';
$lang['info_auth_module'] = 'Le module FrontEndUsers supporte l\'utilisation de méthode alternatives d\'authentification, avec des capacités variables. Certaines fonctionnalités ne vont pas fonctionner ou seront désactivées si la méthode d\'authentification intégrée n\'est pas utilisée.';
$lang['error_user_nonunique_field_value'] = 'La valeur spécifiée pour % s est déjà utilisée par un autre utilisateur';
$lang['unique'] = 'Unique';
$lang['error_nonunique_field_value'] = 'La valeur spécifiée pour % s (% s) n\'est pas unique';
$lang['prompt_force_unique'] = 'Forcer la valeur de cette propriété pour être unique dans tous les comptes utilisateurs';
$lang['help_returnlast'] = 'Utilisé avec les formulaires login et logout, si ce paramètre est spécifié, il indiquera que l\'utilisateur doit être renvoyé vers la page (par URL) que l\'utilisateur avait affiché avant l\'action. Ce paramètre remplace les préférences de redirection, et le paramètre "returnto"';
$lang['help_noinline'] = 'Utilisé avec l\'un des formulaires, ce paramètre spécifie que les formulaires ne devraient pas être mis en ligne, au contraire le résultat de soumission du formulaire remplacera le bloc de contenu par défaut';
$lang['title_reset_session'] = 'Avertissement de fin de session';
$lang['msg_reset_session'] = 'Votre session va bientôt expirer, veuillez cliquer sur "OK" pour rester connecté(e).';
$lang['ok'] = 'OK';
$lang['resetsession_template'] = 'Gabarit de remise à zéro de session';
$lang['info_name'] = 'Ceci est le nom du champ (utilisé avec Smarty). Il doit comporter uniquement des caractères alphanumériques ou des underscore (_).';
$lang['visitors_tab'] = 'Visiteurs';
$lang['feu_groups_prompt'] = 'Sélectionnez un ou plusieurs groupes FEU qui sont autorisés à accéder à cette page';
$lang['error_mustselect_group'] = 'Un groupe doit être sélectionné';
$lang['selectone'] = 'Sélectionner un groupe';
$lang['start_year'] = 'Année de début';
$lang['end_year'] = 'Année de fin';
$lang['date'] = 'Date&nbsp;';
$lang['prompt_thumbnail_size'] = 'Taille de vignette&nbsp;';
$lang['OnUpdateGroup'] = 'Lorsqu\'un groupe d\'utilisateurs est modifié';
$lang['error_toomanyselected'] = 'Utilisateurs sélectionnés trop nombreux pour les opérations... Merci de réduire à 250 ou moins';
$lang['confirm_delete_selected'] = 'Êtes vous sûr(e) de vouloir supprimer les utilisateurs sélectionnés ?';
$lang['delete_selected'] = 'Supprimer la sélection';
$lang['prompt_randomusername'] = 'Générer un nom d\'utilisateur au hasard lors de l\'ajout de nouveaux utilisateurs&nbsp;';
$lang['months'] = 'mois';
$lang['prompt_expireage'] = 'Période d\'expiration par défaut pour l\'utilisateur&nbsp;';
$lang['notification_settings'] = 'Paramètres de notification&nbsp;';
$lang['property_settings'] = 'Paramètres de propriété&nbsp;';
$lang['redirection_settings'] = 'Paramètres de redirection&nbsp;';
$lang['general_settings'] = 'Paramètres généraux&nbsp;';
$lang['session_settings'] = 'Paramètres de Session et Cookie&nbsp;';
$lang['field_settings'] = 'Paramètres des champs&nbsp;';
$lang['error_lostun_nonrequired'] = 'Le drapeau "demandé lors de la récupération de l\'identifiant" ne peut être utilisé que sur les champs obligatoires';
$lang['prop_textarea_wysiwyg'] = 'Permettre l\'utilisation de l\'éditeur visuel (WYSIWYG) sur cette zone de texte';
$lang['editing_user'] = 'Edition d\'utilisateur&nbsp;';
$lang['noinline'] = 'Ne pas mettre en ligne les formulaires';
$lang['info_lostun'] = 'Cliquez ici si vous ne vous souvenez pas de votre identifiant';
$lang['info_forgotpw'] = 'Cliquez ici si vous ne vous souvenez pas de votre mot de passe';
$lang['info_logout'] = 'Cliquez ici pour vous déconnecter';
$lang['info_changesettings'] = 'Cliquez ici pour modifier votre mot de passe et d\'autres informations';
$lang['viewuser_template'] = 'Vue gabarit utilisateur&nbsp;';
$lang['event'] = 'Événement';
$lang['feu_event_notification'] = 'Notification d\'événement module FrontEndUser';
$lang['prompt_notification_address'] = 'Adresse email pour la notification&nbsp;';
$lang['prompt_notification_template'] = 'Gabarit d\'email pour la notification&nbsp;';
$lang['prompt_notification_subject'] = 'Sujet de l\'email pour la notification&nbsp;';
$lang['prompt_notifications'] = 'Notifications par email&nbsp;';
$lang['OnLogin'] = 'À la connexion';
$lang['OnLogout'] = 'À la déconnexion';
$lang['OnExpireUser'] = 'À l\'expiration de la session';
$lang['OnCreateUser'] = 'Lorsqu\'un nouvel utilisateur est créé';
$lang['OnDeleteUser'] = 'Lorsqu\'un utilisateur est supprimé';
$lang['OnUpdateUser'] = 'Lors de changement de paramètres utilisateur';
$lang['OnCreateGroup'] = 'Lorsqu\'un groupe d\'utilisateurs est créé';
$lang['OnDeleteGroup'] = 'Lorsqu\'un groupe d\'utilisateurs est supprimé';
$lang['lostunconfirm_premsg'] = 'La fonction de récupération des détails de login oublié est terminée. Nous avons trouvé un identifiant unique qui correspond aux détails que vous avez entrés.';
$lang['your_username_is'] = 'Votre identifiant est';
$lang['lostunconfirm_postmsg'] = 'Nous vous recommandons d\'enregistrer cette information dans un endroit sûr, mais facile à retrouver pour vous.';
$lang['prompt_after_change_settings'] = 'PageID/Alias où se rendre après la modification&nbsp;';
$lang['prompt_after_verify_code'] = 'L\'ID ou l\'alias de la page où se rendre après la vérification du code *&nbsp;';
$lang['lostun_details_template'] = 'Gabarit pour la récupération des détails d\'identifiant';
$lang['lostun_confirm_template'] = 'Gabarit pour la confirmation de la récupération des détails d\'identifiant';
$lang['error_nonuniquematch'] = 'Erreur&nbsp;: Plus d\'un utilisateur correspond aux propriétés définies';
$lang['error_cantfinduser'] = 'Erreur&nbsp;: Impossible de trouver un utilisateur correspondant';
$lang['error_groupnotfound'] = 'Erreur&nbsp;: Impossible de trouver un groupe de ce nom';
$lang['readonly'] = 'Lecture seule';
$lang['prompt_usermanipulator'] = 'Classe de manipulation des identifiants&nbsp;';
$lang['admin_logout'] = 'Déconnecté par un administrateur';
$lang['prompt_loggedinonly'] = 'Affiche uniquement les utilisateurs connectés';
$lang['prompt_logout'] = 'Déconnecter cet utilisateur';
$lang['user_properties'] = 'Propriétés de l\'utilisateur';
$lang['userhistory'] = 'Historique des utilisateurs';
$lang['export'] = 'Exporter';
$lang['clear'] = 'Vider';
$lang['prompt_exportuserhistory'] = 'Exporter en ASCII l\'historique utilisateur qui a moins de&nbsp;';
$lang['prompt_clearuserhistory'] = 'Vider l\'historique utilisateur qui a plus de&nbsp;';
$lang['title_lostusername'] = 'Avez-vous oublié votre identifiant ?';
$lang['title_rssexport'] = 'Exporter la définition du groupe (et ses propriétés) au format XML';
$lang['title_userhistorymaintenance'] = 'Maintenance de l\'historique utilisateur';
$lang['yes'] = 'Oui';
$lang['no'] = 'Non';
$lang['prompt_of'] = 'de';
$lang['date_allrecords'] = '** Non limité **';
$lang['date_onehourold'] = '1 heure';
$lang['date_sixhourold'] = '6 heures';
$lang['date_twelvehourold'] = '12 heures';
$lang['date_onedayold'] = '1 jour';
$lang['date_oneweekold'] = '1 semaine';
$lang['date_twoweeksold'] = '2 semaines';
$lang['date_onemonthold'] = '1 mois';
$lang['date_threemonthsold'] = '3 mois';
$lang['date_sixmonthsold'] = '6 mois';
$lang['date_oneyearold'] = '1 an';
$lang['title_groupsort'] = 'Grouper et trier&nbsp;';
$lang['prompt_recordsfound'] = 'Enregistrements qui correspondent aux critères';
$lang['sortorder_username_desc'] = 'Ordre descendant des noms d\'utilisateurs';
$lang['sortorder_username_asc'] = 'Ordre ascendant des noms d\'utilisateurs';
$lang['sortorder_date_desc'] = 'Ordre descendant de la date';
$lang['sortorder_date_asc'] = 'Ordre ascendant de la date';
$lang['sortorder_action_desc'] = 'Ordre descendant du type d\'événement';
$lang['sortorder_action_asc'] = 'Ordre ascendant du type d\'événement';
$lang['sortorder_ipaddress_desc'] = 'Ordre descendant de l\'adresse IP';
$lang['sortorder_ipaddress_asc'] = 'Ordre ascendant de l\'adresse IP';
$lang['info_nohistorydetected'] = 'Aucun historique détecté';
$lang['reset'] = 'Réinitialiser';
$lang['prompt_group_ip'] = 'Grouper par adresse IP&nbsp;';
$lang['prompt_filter_eventtype'] = 'Filtre de type d\'événement&nbsp;';
$lang['prompt_filter_date'] = 'Affiche uniquement les événements qui on moins de&nbsp;';
$lang['prompt_pagelimit'] = 'Limite de page&nbsp;';
$lang['for'] = 'pour';
$lang['title_userhistory'] = 'Rapport d\'historique d\'utilisateur';
$lang['unknown'] = 'Inconnu';
$lang['prompt_ipaddress'] = 'Adresse IP';
$lang['prompt_eventtype'] = 'Type d\'événement';
$lang['prompt_date'] = 'Date';
$lang['prompt_return'] = 'Retour';
$lang['import_complete_msg'] = 'Opération d\'importation terminée';
$lang['prompt_linesprocessed'] = 'Lignes effectuées';
$lang['prompt_errors'] = 'Erreurs rencontrées';
$lang['prompt_recordsadded'] = 'Enregristrements ajoutés';
$lang['error_nogroupproprelns'] = 'Impossible de trouver des propriétés pour le groupe %s';
$lang['error_noresponsefromserver'] = 'Aucune réponse du serveur SMTP';
$lang['error_importfilenotfound'] = 'Impossible de trouver le fichier spécifié (%s)';
$lang['error_importfieldvalue'] = 'Valeur invalide pour le champ menu déroulant ou multisélection %s';
$lang['error_importfieldlength'] = 'Le champ %s dépasse la longueur maximale';
$lang['error_importusers'] = 'Erreur d\'importation (ligne %s): %s';
$lang['error_propertydefns'] = 'Récupération des définitions de propriété impossible (erreur interne)';
$lang['error_problemsettinginfo'] = 'Problème lors de la définition des infos utilisateur';
$lang['error_importrequiredfield'] = 'Impossible de trouver une colonne qui correspond au champ requis %s';
$lang['error_nogroupproperties'] = 'Impossible de trouver les propriétés pour le groupe spécifié';
$lang['error_importfileformat'] = 'Le fichier spécifié pour l\'importation n\'est pas au bon format';
$lang['error_couldnotopenfile'] = 'Ouverture de fichier imossible';
$lang['prompt_importdestgroup'] = 'Importer les utilisateurs dans ce groupe&nbsp;';
$lang['prompt_importfilename'] = 'Entrer un fichier CSV&nbsp;';
$lang['prompt_importxmlfile'] = 'Entrer un fichier XML';
$lang['prompt_exportusers'] = 'Exporter des utilisateurs';
$lang['prompt_importusers'] = 'Importer des utilisateurs';
$lang['prompt_clear'] = 'Vider';
$lang['prompt_image_destination_path'] = 'Chemin de destination de l\'image&nbsp;';
$lang['error_missing_upload'] = 'Un problème est apparu avec un téléchargement manquant (mais requis)';
$lang['error_bad_xml'] = 'Impossible d\'analyser le fichier XML fourni';
$lang['error_notemptygroup'] = 'Impossible de supprimer un groupe qui contient encore des utilisateurs';
$lang['error_norepeatedlogins'] = 'Cet utilisateur est déjà connecté';
$lang['error_captchamismatch'] = 'Le texte de cette image n\'a pas été entré correctement';
$lang['prompt_allow_repeated_logins'] = 'Autoriser les utilisateurs à être connectés plus d\'une fois&nbsp;';
$lang['prompt_allowed_image_extensions'] = 'Extensions des fichiers d\'images que les utilisateurs sont autorisés à télécharger&nbsp;';
$lang['event_help_OnRefreshUser'] = '<h3>OnRefreshUser</h3>
<p>An event generated when the user session is refreshed.</p>
<h4>Parameters:</h4>
<ul>
  <li><em>id</em> - The User id</li>
</ul>';
$lang['event_help_OnDeleteUser'] = '<h3>OnDeleteUser<h3>
<p>Un événement est généré quand un utilisateur est supprimé</p>
<h4>Paramètres</h4>
<ul>
<li><em>username</em> - le nom de l\'utilisateur</li>
<li><em>id</em> - l\'id de l\'utilisateur</li>
<li><em>props</em> - Un hachage remplis avec les propriétés de l\'utilisateur</li>
</ul>';
$lang['event_help_OnCreateUser'] = '<h3>OnCreateUser<h3>
<p>Un événement est généré quand un utilisateur est créé</p>
<h4>Paramètres</h4>
<ul>
<li><em>name</em> - le nom de l\'utilisateur</li>
<li><em>id</em> - l\'id de l\'utilisateur</li>
</ul>';
$lang['event_help_OnUpdateUser'] = '<h3>OnUpdateUser<h3>
<p>Un événement est généré quand un utilisateur est mis à jour (par lui-même ou par un admin)</p>
<h4>Paramètres</h4>
<ul>
<li><em>name</em> - le nom de l\'utilisateur</li>
<li><em>id</em> - l\'id de l\'utilisateur</li>
</ul>';
$lang['event_help_OnCreateGroup'] = '<h3>OnCreateGroup<h3>
<p>Un événement est généré quand un groupe est créé</p>
<h4>Paramètres</h4>
<ul>
<li><em>name</em> - le nom du groupe</li>
<li><em>description</em> - la description du groupe</li>
<li><em>id</em> - l\'id du groupe</li>
</ul>';
$lang['event_help_OnDeleteGroup'] = '<h3>OnDeleteGroup<h3>
<p>Un événement est généré quand un groupe est supprimé</p>
<h4>Paramètres</h4>
<ul>
<li><em>name</em> - le nom du groupe</li>
<li><em>id</em> - l\'id du groupe</li>
</ul>';
$lang['event_help_OnLogin'] = '<h3>OnLogin<h3>
<p>Un événement est généré quand un utilisateur se connecte</p>
<h4>Paramètres</h4>
<ul>
<li><em>username</em> - le nom de l\'utilisateur connecté</li>
<li><em>ip</em> - l\'adresse ip du client</li>
</ul>';
$lang['event_help_OnLogout'] = '<h3>OnLogout<h3>
<p>Un événement est généré quand un utilisateur se déconnecte</p>
<h4>Paramètres</h4>
<ul>
<li><em>username</em> - le nom de l\'utilisateur déconnecté</li>
<li><em>id</em> - l\'id de l\'utilisateur</li>
</ul>';
$lang['event_help_OnExpireUser'] = '<h3>OnExpireUser<h3>
<p>Un événement est généré quand une session expire</p>
<h4>Paramètres</h4>
<ul>
<li><em>username</em> - le nom de l\'utilisateur dont la session a expiré</li>
<li><em>id</em> - l\'id de l\'utilisateur dont la session a expiré</li>
</ul>';
$lang['event_info_OnLogin'] = 'Un événement est généré quand un utilisateur se connecte';
$lang['event_info_OnLogout'] = 'Un événement est généré quand un utilisateur se déconnecte';
$lang['event_info_OnExpireUser'] = 'Un événement est généré quand une session expire';
$lang['event_info_OnCreateUser'] = 'Un événement est généré quand un utilisateur est créé';
$lang['event_info_OnRefreshUser'] = 'An event generated when the user session is refreshed';
$lang['event_info_OnUpdateUser'] = 'Un événement est généré quand un utilisateur est mis à jour (par lui-même ou par un admin)';
$lang['event_info_OnDeleteUser'] = 'Un événement est généré quand un utilisateur est supprimé';
$lang['event_info_OnCreateGroup'] = 'Un événement est généré quand un groupe est créé';
$lang['event_info_OnUpdateGroup'] = 'Un événement est généré quand un groupe est mis à jour';
$lang['event_info_OnDeleteGroup'] = 'Un événement est généré quand un groupe est supprimé';
$lang['backend_group'] = 'Groupe';
$lang['info_star'] = '*Les champs suivants sont gabarits Smarty.<br/>Avec les variables existantes  smarty et les plugins,  les macros suivantes peuvent être utilisées dans ces champs : {$username},{$group}. Lors de l\'utilisation de la macro {$group}, le système remplace le nom du premier groupe auquel l\'utilisateur appartient, et va le rediriger sur cette page.';
$lang['info_admin_password'] = 'Éditer ce champ pour réinitialiser le mot de passe utilisateur';
$lang['info_admin_repeatpassword'] = 'Éditer ce champ pour réinitialiser le mot de passe utilisateur';
$lang['error_username_exists'] = 'Un utilisateur avec ce nom existe déjà.';
$lang['nocsvresults'] = 'Aucun résultat retourné de l\'export csv';
$lang['prompt_unfldlen'] = 'Longueur du champ nom d\'utilisateur&nbsp;';
$lang['prompt_pwfldlen'] = 'Longueur du champ mot de passe&nbsp;';
$lang['error_invalidpasswordlengths'] = 'Longueur minimale/maximale invalide pour le mot de passe&nbsp;';
$lang['error_invalidusernamelengths'] = 'Longueur minimale/maximale invalide pour le nom d\'utilisateur&nbsp;';
$lang['error_invalidemailaddress'] = 'Adresse email invalide';
$lang['error_noemailaddress'] = 'Il n\'y a pas d\'adresse email enregistrée pour ce compte.';
$lang['error_problemseettinginfo'] = 'Problème lors de l\'édition des infos utilisateur';
$lang['error_settingproperty'] = 'Problème lors de l\'édition de la propriété';
$lang['user_added'] = 'Utilisateur ajouté %s = %s';
$lang['user_deleted'] = 'Utilisateur supprimé uid=%s';
$lang['propertyfilter'] = 'Propriété';
$lang['valueregex'] = 'Valeur (expression régulière)';
$lang['warning_effectsfieldlength'] = 'Attention : ces champs affectent la taille de champs d\'entrée dans les formulaires.  Diminuer cette valeur sur un site existant n\'est pas recommandé';
$lang['confirm_submitprefs'] = 'Modifier les préférences administrateur&nbsp;?';
$lang['error_emailalreadyused'] = 'Cette adresse email est déjà utilisée';
$lang['prompt_usecookiestoremember'] = 'Utiliser les cookies pour mémoriser les détails d\'identification&nbsp;';
$lang['prompt_cookiename'] = 'Le nom du cookie&nbsp;';
$lang['prompt_allow_duplicate_emails'] = 'Autoriser les doublons d\'email&nbsp;';
$lang['prompt_username_is_email'] = 'L\'adresse email est le nom d\'utilisateur&nbsp;';
$lang['info_cookie_keepalive'] = 'Tente de garder les connexions actives par l\'utilisation de cookies <em>le cookie est réinitialisé par l\'activité sur le site</em>';
$lang['info_allow_duplicate_emails'] = '(Autoriser plusieurs utilisateurs partageant la même adresse email)';
$lang['info_username_is_email'] = '(L\'adresse email est le nom de l\'utilisateur -- Ne pas cocher si vous choisissez "Autoriser les doublons d\'email" !)';
$lang['prompt_allow_duplicate_reminders'] = 'Autoriser des demandes multiples de mot de passe oublié&nbsp;';
$lang['info_allow_duplicate_reminders'] = '(Autoriser les utilisateurs à re-demander une réinitialisation du mot de passe, malgré qu\'ils n\'aient pas utilisé une précédente demande)';
$lang['prompt_feusers_specific_permissions'] = 'Utiliser les permissions spécifique de FEUsers ?&nbsp;';
$lang['info_feusers_specific_permissions'] = '(Normalement, les permissions de FEUsers sont identiques aux permissions du panneau d\'administration tel que Ajouter un utilisateur, Ajouter une groupe, etc. Si vous sélectionnez cette option, il y aura des permissions différentes pour FEUsers.)';
$lang['error_missingupload'] = 'Impossible de trouver le fichier chargé (erreur interne)';
$lang['error_problem_upload'] = 'Il y a eu un problème avec le fichier chargé. Veuillez réessayer.';
$lang['error_missingusername'] = 'Vous n\'avez pas entré de nom utilisateur';
$lang['error_missingemail'] = 'Vous ne devez pas entrer votre adresse email';
$lang['error_missingpassword'] = 'Vous n\'avez pas entré de mot de passe';
$lang['frontenduser_logout'] = 'Déconnexion utilisateur';
$lang['frontenduser_loggedin'] = 'Connexion utilisateur';
$lang['editprop_infomsg'] = '<font color="red"><b>ATTENTION :</b> en changeant une propriété qui a été assignée à des groupes, vous pouvez potentiellement détruire ou abîmer un site existant <i>(en particulier si vous réduisez les longueurs de champs, etc)</i></font>';
$lang['info_smtpvalidate'] = 'Cette fonction ne marche pas sous Windows';
$lang['msg_dontcreateusername'] = 'Ne créez pas de propriété pour utilisateur (nom d\'utilisateur et mot de passe), car ceci est inclus dans le module FrontEndUsers';
$lang['prompt_exportcsv'] = 'Exporter la liste des utilisateurs au format CSV&nbsp;';
$lang['exportcsv'] = 'Exporter';
$lang['importcsv'] = 'Importer';
$lang['admin'] = 'Admin';
$lang['editprop'] = 'Éditer la propriété';
$lang['maxlength'] = 'Longueur maximale';
$lang['created'] = 'Créé';
$lang['sortby'] = 'Trier par&nbsp;';
$lang['sort'] = 'Tri&nbsp;';
$lang['usersingroup'] = 'Utilisateurs dans le groupe';
$lang['userlimit'] = 'Limiter les résultats à';
$lang['error_noemailfield'] = 'Aucun email trouvé pour cet utilisateur. Vous devez éventuellement contacter l\'administrateur.';
$lang['prompt_forgotpw_page'] = 'PageID/Alias du formulaire mot de passe oublié&nbsp;';
$lang['prompt_changesettings_page'] = 'PageID/Alias du formulaire de changement de paramètres&nbsp;';
$lang['prompt_login_page'] = 'PageID/Alias où rediriger l\'utilisateur après qu\'il se soit connecté&nbsp;';
$lang['prompt_logout_page'] = 'PageID/Alias où rediriger l\'utilisateur après qu\'il se soit déconnecté&nbsp;';
$lang['sortorder'] = 'Orde de tri';
$lang['prompt_numresetrecord'] = 'Un nombre d\'utilisateurs est en cours de réinitialisation de mots de passe. Ce nombre est actuellement de :';
$lang['remove1week'] = 'Supprimer toutes les entrées vieilles de plus d\'une semaine';
$lang['remove1month'] = 'Supprimer toutes les entrées vieilles de plus d\'un mois';
$lang['removeall'] = 'Supprimer toutes les entrées';
$lang['areyousure'] = 'Êtes-vous sûr(e)&nbsp;?';
$lang['error_invalidcode'] = 'Un code invalide a été entré, veuillez réessayer';
$lang['error_tempcodenotfound'] = 'Le code temporaire pour votre id utilisateur n\'a pas pu être trouvé dans la base de données';
$lang['forgotpassword_verifytemplate'] = 'Gabarit utilisé pour afficher le formulaire de vérification';
$lang['forgotpassword_emailtemplate'] = 'Gabarit utilisé pour l\'email envoyé lors de l\'oubli du mot de passe';
$lang['error_resetalreadysent'] = 'Une demande de réinitialisation de mot de passe a été soumise pour ce compte, soit par vous-même, soit par quelqu\'un d\'autre. Vérifiez votre email, vous y trouverez les instructions pour la réinitialisation de votre mot de passe.';
$lang['error_dberror'] = 'Erreur de base de données';
$lang['message_forgotpwemail'] = 'Vous recevez ce message car quelqu\'un (peut être vous) a fait une demande de récupération de mot de passe. Si c\'est le cas, lisez les instructions ci-dessous. Si vous ne savez pas de quoi il s\'agit ou si ce n\'est pas vous, vous pouvez simplement effacer ce message (cela n\'aura aucune conséquence sur votre compte). Nous vous remercions.';
$lang['prompt_code'] = 'Code';
$lang['message_code'] = 'Le code suivant a été généré au hasard pour la vérification du compte utilisateur. Lorsque vous cliquerez sur le lien ci-dessous, vous trouverez un champ dans lequel entrer ce code. Normalement, ce champ est rempli pour vous, mais dans le cas contraire, le code est :';
$lang['prompt_link'] = 'Le lien suivant vous amène au site où vous pourrez entrer le code ci-dessus, et réinitialiser votre mot de passe :';
$lang['lostpassword_emailsubject'] = 'Mot de passe oublié';
$lang['error_nomailermodule'] = 'Le module CMSMailer n\'a pas été trouvé';
$lang['info_forgotpwmessagesent'] = 'Un email a été envoyé à %s avec les instructions pour la réinitialisation du mot de passe. Merci';
$lang['lostpw_message'] = 'Si vous avez oublié votre mot de passe, veuillez entrer votre identifiant ici, et si nous le trouvons, vous recevrez un email avec les instructions pour la réinitialisation du mot de passe.';
$lang['forgotpassword_template'] = 'Gabarit pour l\'oubli du mot de passe';
$lang['lostusername_template'] = 'Gabarit pour la récupération de l\'identifiant';
$lang['error_propnotfound'] = 'La propriété %s n\'a pas été trouvée';
$lang['propsfound'] = 'propriétés trouvées';
$lang['addprop'] = 'Ajouter une propriété';
$lang['error_requiredfield'] = 'Un champ requis (%s) est vide';
$lang['info_emptypasswordfield'] = 'Veuillez entrer ici un nouveau mot de passe';
$lang['error_notloggedin'] = 'Vous ne semblez pas être connecté';
$lang['user_settings'] = 'Paramètres';
$lang['user_registration'] = 'Enregistrement';
$lang['error_accountexpired'] = 'Ce compte est périmé';
$lang['error_improperemailformat'] = 'Format d\'adresse email invalide';
$lang['error_invalidexpirydate'] = 'Date d\'expiration invalide. Essayez avec année antérieure';
$lang['error_problemsettingproperty'] = 'Il y a eu une erreur lors de la définition %s pour l\'utilisateur $s';
$lang['error_invalidgroupid'] = 'id de groupe %s invalide';
$lang['hiddenfieldmarker'] = 'Marqueur de champ caché&nbsp;';
$lang['hiddenfieldcolor'] = 'Couleur de champ caché&nbsp;';
$lang['hidden'] = 'Caché';
$lang['error_duplicatename'] = 'Une propriété du même nom est déjà définie';
$lang['error_noproperties'] = 'Aucune propriété définie';
$lang['error_norelations'] = 'Aucun propriété n\'a été sélectionnée pour ce groupe';
$lang['nogroups'] = 'Aucun groupe défini';
$lang['groupsfound'] = 'Groupes trouvés';
$lang['error_onegrouprequired'] = 'L\'appartenance à au moins un groupe est requise';
$lang['prompt_requireonegroup'] = 'Requiert l\'appartenance à au moins un groupe&nbsp;';
$lang['back'] = 'Retour';
$lang['error_missing_required_param'] = '%s est un champ requis';
$lang['requiredfieldmarker'] = 'Marqueur de champs requis&nbsp;';
$lang['requiredfieldcolor'] = 'Mise en évidence des champs requis en&nbsp;';
$lang['next'] = 'Suivant';
$lang['error_groupexists'] = 'Un groupe du même nom existe déjà';
$lang['required'] = 'Champ requis';
$lang['optional'] = 'Optionel';
$lang['off'] = 'Désactivé';
$lang['size'] = 'Taille';
$lang['sizecomment'] = '<br/>(Taille maximale d\'une des dimensions de l\'image en pixels)';
$lang['length'] = 'Longueur';
$lang['lengthcomment'] = '<br>(caractères dans le champ texte)';
$lang['seloptions'] = 'Options menu déroulant, séparées par des retours à la ligne. Les valeurs peuvent être séparées du texte par le caractère =.
Ex : Femme=f';
$lang['radiooptions'] = 'Label des boutons Radio séparés par des sauts de ligne. Les valeurs peuvent être séparés du texte par le caractère =.
Exemple : Femme = f';
$lang['prompt'] = 'Invite de saisie';
$lang['prompt_type'] = 'Type';
$lang['type'] = 'Type';
$lang['fieldstatus'] = 'Statut du champ';
$lang['usedinlostun'] = 'Demande lors de la récupération de<br/>l\'identifiant';
$lang['text'] = 'Texte';
$lang['checkbox'] = 'Case à cocher';
$lang['multiselect'] = 'Liste multi-sélection';
$lang['radiobuttons'] = 'Boutons Radio';
$lang['image'] = 'Image ';
$lang['email'] = 'Adresse email ';
$lang['textarea'] = 'Champ de texte';
$lang['dropdown'] = 'Menu déroulant';
$lang['msg_currentlyloggedinas'] = 'Bienvenue';
$lang['logout'] = 'Déconnexion';
$lang['prompt_newgroupname'] = 'Utiliser le nom de ce groupe';
$lang['prompt_changesettings'] = 'Changement de mes paramètres';
$lang['error_loginfailed'] = 'La connexion a échoué : identifiant ou mot de passe invalide ?';
$lang['login'] = 'S\'identifier';
$lang['prompt_signin_button'] = 'Texte du bouton de connexion&nbsp;';
$lang['prompt_username'] = 'Identifiant';
$lang['prompt_email'] = 'Adresse email';
$lang['prompt_password'] = 'Mot de passe ';
$lang['prompt_rememberme'] = 'Me mémoriser sur cet ordinateur';
$lang['register'] = 'S\'enregistrer';
$lang['forgotpw'] = 'Mot de passe oublié ?';
$lang['lostusername'] = 'Détails d\'identification oubliés ?';
$lang['defaults'] = 'Par défaut';
$lang['template'] = 'Gabarit';
$lang['error_usernotfound'] = 'ID utilisateur non trouvé';
$lang['error_usernametaken'] = 'Cet identifiant (%s) existe déjà';
$lang['prompt_smtpvalidate'] = 'Utiliser SMTP pour la validation des adresses email&nbsp;?';
$lang['prompt_minpwlen'] = 'Longueur minimale du mot de passe&nbsp;';
$lang['prompt_maxpwlen'] = 'Longueur maximale du mot de passe&nbsp;';
$lang['prompt_minunlen'] = 'Longueur minimale de l\'identifiant&nbsp;';
$lang['prompt_maxunlen'] = 'Longueur maximale de l\'identifiant&nbsp;';
$lang['prompt_sessiontimeout'] = 'Expiration de session (secondes)&nbsp;';
$lang['prompt_cookiekeepalive'] = 'Utiliser les cookies pour garder les connexions actives&nbsp;';
$lang['prompt_allowemailreg'] = 'Autorise l\'enregistrement par email';
$lang['prompt_dfltgroup'] = 'Groupe par défaut pour les nouveaux utilisateurs&nbsp;';
$lang['changesettings_template'] = 'Gabarit pour le changement des paramètres';
$lang['error_passwordmismatch'] = 'Les mots de passe ne concordent pas';
$lang['error_invalidusername'] = 'Identifiant non valide';
$lang['error_invalidpassword'] = 'Mot de passe non valide';
$lang['edituser'] = 'Éditer l\'utilisateur';
$lang['valid'] = 'Valide';
$lang['username'] = 'Identifiant';
$lang['status'] = 'Statut';
$lang['error_membergroups'] = 'Cet utilisateur n\'est membre d\'aucun groupe';
$lang['error_properties'] = 'Aucune propriété';
$lang['error_dup_properties'] = 'Tente d\'importer des propriétés à double';
$lang['value'] = 'Valeur';
$lang['groups'] = 'Groupes';
$lang['properties'] = 'Propriétés';
$lang['propname'] = 'Nom de propriété';
$lang['propvalue'] = 'Valeur de la propriété';
$lang['add'] = 'Ajouter';
$lang['history'] = 'Historique';
$lang['edit'] = 'Éditer';
$lang['expires'] = 'Expire';
$lang['specify_date'] = 'Spécifiez une date';
$lang['12hrs'] = '12 heures';
$lang['24hrs'] = '24 heures';
$lang['48hrs'] = '48 heures';
$lang['1week'] = '1 semaine';
$lang['2weeks'] = '2 semaines';
$lang['1month'] = '1 mois';
$lang['3months'] = '3 mois';
$lang['6months'] = '6 mois';
$lang['1year'] = '1 an';
$lang['never'] = 'Jamais';
$lang['postinstallmessage'] = 'Le module a été installé avec succès.<br/>Assurez-vous de définir la permission "Modify FrontEndUser Properties". De plus, nous vous recommandons d\'installer le module Captcha. Lorsque celui-ci est installé, la validation de l\'image captcha sera requise pour se connecter, en plus de l\'identifiant et du mot de passe. Ceci est conseillé pour éviter les attaques.

<strong>Note:</strong> Le paramètre \'nocaptcha\' peut être utilisé pour désactiver cette fonction même lorsque le module Captcha est installé.

Le module SelfRegistration doit être installé pour que le visiteurs puissent s\'inscrire sur votre site. Sinon, vous devrez les enregistrer vous même.';
$lang['password'] = 'Mot de passe';
$lang['repeatpassword'] = 'Re-tapez le mot de passe';
$lang['error_groupname_exists'] = 'Un groupe du même nom existe déjà';
$lang['editgroup'] = 'Éditer le groupe';
$lang['submit'] = 'Valider';
$lang['cancel'] = 'Annuler';
$lang['delete'] = 'Supprimer';
$lang['confirm_editgroup'] = 'Êtes-vous sûr(e) que cette propriété est correcte pour ce groupe&nbsp;?\nDésactiver une propriété n\'effacera pas les entrées dans la table des propriétés pour ce groupe/utilisateur. Tout au plus, les propriétés ne seront pas disponibles.';
$lang['areyousure_deletegroup'] = 'Êtes-vous sûr(e) de vouloir supprimer ce groupe&nbsp;?';
$lang['confirm_delete_prop'] = 'Êtes-vous sûr(e) de vouloir complètement supprimer cette propriété?\nCela supprimera toutes les entrées pour cette propriété';
$lang['error_insufficientparams'] = 'Paramètres insuffisants';
$lang['id'] = 'Id';
$lang['name'] = 'Nom';
$lang['error_cantaddprop'] = 'Problème lors de l\'ajout d\'une propriété';
$lang['error_cantaddgroupreln'] = 'Problème lors de l\'ajout d\'une relation de groupe';
$lang['error_cantaddgroup'] = 'Problème lors de l\'ajout d\'un groupe';
$lang['error_cantassignuser'] = 'Problème lors de l\'ajout d\'un utilisateur à un groupe';
$lang['error_couldnotdeleteproperty'] = 'Problème lors de la suppression d\'une propriété';
$lang['error_couldnotfindemail'] = 'Impossible de trouver une adresse email';
$lang['error_destinationnotwritable'] = 'Pas d\'accès en écriture dans le dossier de destination';
$lang['error_invalidparams'] = 'Paramètres non valides';
$lang['error_nogroups'] = 'Aucun groupe trouvé';
$lang['applyfilter'] = 'Appliquer';
$lang['filter'] = 'Filtre&nbsp;';
$lang['userfilter'] = 'Identifiant (expression régulière)&nbsp;';
$lang['description'] = 'Description';
$lang['groupname'] = 'Nom du groupe';
$lang['accessdenied'] = 'Accès refusé';
$lang['error'] = 'Erreur';
$lang['addgroup'] = 'Ajouter un groupe';
$lang['importgroup'] = 'Importer le groupe';
$lang['adduser'] = 'Ajouter un utilisateur';
$lang['usersfound'] = 'Utilisateurs trouvés';
$lang['group'] = 'Groupe';
$lang['selectgroup'] = 'Sélectionner le groupe';
$lang['registration_template'] = 'Gabarit d\'enregistrement';
$lang['logout_template'] = 'Gabarit de déconnexion';
$lang['login_template'] = 'Gabarit de connexion';
$lang['preferences'] = 'Préférences';
$lang['users'] = 'Utilisateurs';
$lang['friendlyname'] = 'Gestion des utilisateurs du site';
$lang['moddescription'] = 'Gère les utilisateurs du site';
$lang['defaultfrontpage'] = 'Page par défaut';
$lang['lastaccessedpage'] = 'Dernière page accédée';
$lang['otherpage'] = 'Autre page&nbsp;:';
$lang['captcha_title'] = 'Veuillez entrer le texte de l\'image';
?>