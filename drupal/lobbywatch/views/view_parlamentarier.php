$view = new view();
$view->name = 'parlamentarier_liste';
$view->description = '';
$view->tag = 'lobbywatch';
$view->base_table = 'v_parlamentarier';
$view->human_name = 'Parlamentarier Liste';
$view->core = 7;
$view->api_version = '3.0';
$view->disabled = FALSE; /* Edit this to true to make a default view disabled initially */

/* Display: Master */
$handler = $view->new_display('default', 'Master', 'default');
$handler->display->display_options['title'] = 'Parlamentarier';
$handler->display->display_options['use_more_always'] = FALSE;
$handler->display->display_options['access']['type'] = 'perm';
$handler->display->display_options['access']['perm'] = 'access lobbywatch general content';
$handler->display->display_options['cache']['type'] = 'none';
$handler->display->display_options['query']['type'] = 'views_query';
$handler->display->display_options['exposed_form']['type'] = 'basic';
$handler->display->display_options['exposed_form']['options']['reset_button'] = TRUE;
$handler->display->display_options['exposed_form']['options']['reset_button_label'] = 'Zurücksetzen';
$handler->display->display_options['exposed_form']['options']['autosubmit'] = TRUE;
$handler->display->display_options['exposed_form']['options']['autosubmit_hide'] = FALSE;
$handler->display->display_options['pager']['type'] = 'full';
$handler->display->display_options['pager']['options']['items_per_page'] = '100';
$handler->display->display_options['pager']['options']['tags']['first'] = '« erste Seite';
$handler->display->display_options['pager']['options']['tags']['previous'] = '‹ vorherige Seite';
$handler->display->display_options['pager']['options']['tags']['next'] = 'nächste Seite ›';
$handler->display->display_options['pager']['options']['tags']['last'] = 'letzte Seite »';
$handler->display->display_options['style_plugin'] = 'grid';
$handler->display->display_options['row_plugin'] = 'fields';
$handler->display->display_options['row_options']['inline'] = array(
  'ratstyp' => 'ratstyp',
  'partei' => 'partei',
  'kanton' => 'kanton',
);
$handler->display->display_options['row_options']['separator'] = ', ';
$handler->display->display_options['row_options']['hide_empty'] = TRUE;
/* Feld: Parlamentarier: Id */
$handler->display->display_options['fields']['id']['id'] = 'id';
$handler->display->display_options['fields']['id']['table'] = 'v_parlamentarier';
$handler->display->display_options['fields']['id']['field'] = 'id';
$handler->display->display_options['fields']['id']['label'] = '';
$handler->display->display_options['fields']['id']['exclude'] = TRUE;
$handler->display->display_options['fields']['id']['element_label_colon'] = FALSE;
/* Feld: Parlamentarier: Name */
$handler->display->display_options['fields']['name']['id'] = 'name';
$handler->display->display_options['fields']['name']['table'] = 'v_parlamentarier';
$handler->display->display_options['fields']['name']['field'] = 'name';
$handler->display->display_options['fields']['name']['label'] = '';
$handler->display->display_options['fields']['name']['exclude'] = TRUE;
$handler->display->display_options['fields']['name']['element_label_colon'] = FALSE;
/* Feld: Parlamentarier: Bildchen */
$handler->display->display_options['fields']['kleinbild']['id'] = 'kleinbild';
$handler->display->display_options['fields']['kleinbild']['table'] = 'v_parlamentarier';
$handler->display->display_options['fields']['kleinbild']['field'] = 'kleinbild';
$handler->display->display_options['fields']['kleinbild']['label'] = '';
$handler->display->display_options['fields']['kleinbild']['alter']['alter_text'] = TRUE;
$handler->display->display_options['fields']['kleinbild']['alter']['text'] = '<img src="/sites/lobbywatch.ch/app/auswertung/parlamentarierBilder/[kleinbild]" alt="[name]" />';
$handler->display->display_options['fields']['kleinbild']['alter']['make_link'] = TRUE;
$handler->display->display_options['fields']['kleinbild']['alter']['path'] = 'parlamentarier/[id]';
$handler->display->display_options['fields']['kleinbild']['alter']['alt'] = '[name]';
$handler->display->display_options['fields']['kleinbild']['element_label_colon'] = FALSE;
/* Feld: Parlamentarier: Anzeigename */
$handler->display->display_options['fields']['anzeige_name']['id'] = 'anzeige_name';
$handler->display->display_options['fields']['anzeige_name']['table'] = 'v_parlamentarier';
$handler->display->display_options['fields']['anzeige_name']['field'] = 'anzeige_name';
$handler->display->display_options['fields']['anzeige_name']['label'] = '';
$handler->display->display_options['fields']['anzeige_name']['alter']['make_link'] = TRUE;
$handler->display->display_options['fields']['anzeige_name']['alter']['path'] = 'parlamentarier/[id]';
$handler->display->display_options['fields']['anzeige_name']['element_label_colon'] = FALSE;
/* Feld: Parlamentarier: Rat */
$handler->display->display_options['fields']['ratstyp']['id'] = 'ratstyp';
$handler->display->display_options['fields']['ratstyp']['table'] = 'v_parlamentarier';
$handler->display->display_options['fields']['ratstyp']['field'] = 'ratstyp';
$handler->display->display_options['fields']['ratstyp']['label'] = '';
$handler->display->display_options['fields']['ratstyp']['element_label_colon'] = FALSE;
/* Feld: Parlamentarier: Partei */
$handler->display->display_options['fields']['partei']['id'] = 'partei';
$handler->display->display_options['fields']['partei']['table'] = 'v_parlamentarier';
$handler->display->display_options['fields']['partei']['field'] = 'partei';
$handler->display->display_options['fields']['partei']['label'] = '';
$handler->display->display_options['fields']['partei']['element_label_colon'] = FALSE;
$handler->display->display_options['fields']['partei']['empty'] = 'parteilos';
/* Feld: Parlamentarier: Kanton */
$handler->display->display_options['fields']['kanton']['id'] = 'kanton';
$handler->display->display_options['fields']['kanton']['table'] = 'v_parlamentarier';
$handler->display->display_options['fields']['kanton']['field'] = 'kanton';
$handler->display->display_options['fields']['kanton']['label'] = '';
$handler->display->display_options['fields']['kanton']['element_label_colon'] = FALSE;
/* Sort criterion: Parlamentarier: Anzeigename */
$handler->display->display_options['sorts']['anzeige_name']['id'] = 'anzeige_name';
$handler->display->display_options['sorts']['anzeige_name']['table'] = 'v_parlamentarier';
$handler->display->display_options['sorts']['anzeige_name']['field'] = 'anzeige_name';
/* Filter criterion: Parlamentarier: Kanton */
$handler->display->display_options['filters']['kanton']['id'] = 'kanton';
$handler->display->display_options['filters']['kanton']['table'] = 'v_parlamentarier';
$handler->display->display_options['filters']['kanton']['field'] = 'kanton';
$handler->display->display_options['filters']['kanton']['group'] = 1;
$handler->display->display_options['filters']['kanton']['exposed'] = TRUE;
$handler->display->display_options['filters']['kanton']['expose']['operator_id'] = 'kanton_op';
$handler->display->display_options['filters']['kanton']['expose']['label'] = 'Kanton';
$handler->display->display_options['filters']['kanton']['expose']['operator'] = 'kanton_op';
$handler->display->display_options['filters']['kanton']['expose']['identifier'] = 'kanton';
$handler->display->display_options['filters']['kanton']['expose']['remember_roles'] = array(
  2 => '2',
  1 => 0,
  4 => 0,
  5 => 0,
  3 => 0,
);
/* Filter criterion: Parlamentarier: Partei */
$handler->display->display_options['filters']['partei']['id'] = 'partei';
$handler->display->display_options['filters']['partei']['table'] = 'v_parlamentarier';
$handler->display->display_options['filters']['partei']['field'] = 'partei';
$handler->display->display_options['filters']['partei']['group'] = 1;
$handler->display->display_options['filters']['partei']['exposed'] = TRUE;
$handler->display->display_options['filters']['partei']['expose']['operator_id'] = 'partei_op';
$handler->display->display_options['filters']['partei']['expose']['label'] = 'Partei';
$handler->display->display_options['filters']['partei']['expose']['operator'] = 'partei_op';
$handler->display->display_options['filters']['partei']['expose']['identifier'] = 'partei';
$handler->display->display_options['filters']['partei']['expose']['remember_roles'] = array(
  2 => '2',
  1 => 0,
  4 => 0,
  5 => 0,
  3 => 0,
);
/* Filter criterion: Parlamentarier: Rat */
$handler->display->display_options['filters']['ratstyp']['id'] = 'ratstyp';
$handler->display->display_options['filters']['ratstyp']['table'] = 'v_parlamentarier';
$handler->display->display_options['filters']['ratstyp']['field'] = 'ratstyp';
$handler->display->display_options['filters']['ratstyp']['group'] = 1;
$handler->display->display_options['filters']['ratstyp']['exposed'] = TRUE;
$handler->display->display_options['filters']['ratstyp']['expose']['operator_id'] = 'ratstyp_op';
$handler->display->display_options['filters']['ratstyp']['expose']['label'] = 'Rat';
$handler->display->display_options['filters']['ratstyp']['expose']['operator'] = 'ratstyp_op';
$handler->display->display_options['filters']['ratstyp']['expose']['identifier'] = 'ratstyp';
$handler->display->display_options['filters']['ratstyp']['expose']['remember_roles'] = array(
  2 => '2',
  1 => 0,
  4 => 0,
  5 => 0,
  3 => 0,
);
/* Filter criterion: Parlamentarier: Im Rat bis */
$handler->display->display_options['filters']['im_rat_bis']['id'] = 'im_rat_bis';
$handler->display->display_options['filters']['im_rat_bis']['table'] = 'v_parlamentarier';
$handler->display->display_options['filters']['im_rat_bis']['field'] = 'im_rat_bis';
$handler->display->display_options['filters']['im_rat_bis']['operator'] = 'empty';
$handler->display->display_options['filters']['im_rat_bis']['group'] = 1;
$handler->display->display_options['filters']['im_rat_bis']['expose']['operator_id'] = 'im_rat_bis_op';
$handler->display->display_options['filters']['im_rat_bis']['expose']['label'] = 'Im Rat bis';
$handler->display->display_options['filters']['im_rat_bis']['expose']['operator'] = 'im_rat_bis_op';
$handler->display->display_options['filters']['im_rat_bis']['expose']['identifier'] = 'im_rat_bis';
/* Filter criterion: Parlamentarier: Kommissionen */
$handler->display->display_options['filters']['kommissionen']['id'] = 'kommissionen';
$handler->display->display_options['filters']['kommissionen']['table'] = 'v_parlamentarier';
$handler->display->display_options['filters']['kommissionen']['field'] = 'kommissionen';
$handler->display->display_options['filters']['kommissionen']['operator'] = 'contains';
$handler->display->display_options['filters']['kommissionen']['exposed'] = TRUE;
$handler->display->display_options['filters']['kommissionen']['expose']['operator_id'] = 'kommissionen_op';
$handler->display->display_options['filters']['kommissionen']['expose']['label'] = 'Kommissionen';
$handler->display->display_options['filters']['kommissionen']['expose']['operator'] = 'kommissionen_op';
$handler->display->display_options['filters']['kommissionen']['expose']['identifier'] = 'kommissionen';
$handler->display->display_options['filters']['kommissionen']['expose']['remember_roles'] = array(
  2 => '2',
  1 => 0,
  4 => 0,
  5 => 0,
  3 => 0,
);

/* Display: Page */
$handler = $view->new_display('page', 'Page', 'page');
$handler->display->display_options['exposed_block'] = TRUE;
$handler->display->display_options['path'] = 'parlamentarier';