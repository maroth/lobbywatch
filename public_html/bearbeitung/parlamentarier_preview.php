<?php

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *                                   ATTENTION!
 * If you see this message in your browser (Internet Explorer, Mozilla Firefox, Google Chrome, etc.)
 * this means that PHP is not properly installed on your web server. Please refer to the PHP manual
 * for more details: http://php.net/manual/install.php
 *
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 */

/**
 * This file was written quick and dirty. ;-)
 */

//phpinfo();

include_once dirname(__FILE__) . '/../custom/custom_page.php';


// Main

// lobbywatch_set_language('fr');

// df(lt('test'), 'lt-test');

// df(lobbywatch_lang_field('organisation.name'));
// df(lobbywatch_lang_field('organisation.name_de'));

// lobbywatch_set_language('de');
// df(lobbywatch_lang_field('organisation.name'));
// df(lobbywatch_lang_field('organisation.name_de'));

try {
    $param = 'pk0';
    if (GetApplication()->IsGETValueSet($param)){
      if (!($id = GetApplication()->GetGETValue($param))) {
        throw new Exception('ID missing');
      }
    } else {
      throw new Exception('ID parameter missing, e.g. ?pk0=215');
   }

//     $con_factory = new MyPDOConnectionFactory();
//     $options = GetConnectionOptions();
//     $eng_con = $con_factory->CreateConnection($options);
// //     try {
//       $eng_con->Connect();
//       $con = $eng_con->GetConnectionHandle();
// //         df($eng_con->Connected(), 'connected');
// //         df($con, 'con');
//       $cmd = $con_factory->CreateEngCommandImp();

    $con = getDBConnectionHandle();
    set_db_session_parameters($con);

    $lang = $parlamentarier_lang = get_parlamentarier_lang($con, $id);
    lobbywatch_set_language($lang);
    $lang_suffix = get_lang_suffix($lang);

    $rowData = get_parlamentarier($con, $id);

    $reAuthorization = isset($rowData['autorisierung_verschickt_datum']);

    $emailSubjectParlam = getSettingValue("parlamentarierAutorisierungEmailSubject$lang_suffix", false, 'Interessenbindungen');
    $emailIntroParlam = getSettingValue('parlamentarier' . ($reAuthorization ? 'Re' : '') . "AutorisierungEmailEinleitung$lang_suffix", false, '[Einleitung]<br><br>');
    $emailEndParlam = getSettingValue('parlamentarier' . ($reAuthorization ? 'Re' : '') . "AutorisierungEmailSchluss$lang_suffix", false, '<br><br>Freundliche Grüsse<br>%name%');
    $emailEndParlam = StringUtils::ReplaceVariableInTemplate($emailEndParlam, 'name', getFullUsername(Application::Instance()->GetCurrentUser()));

    //df($rowData);
    $rowCellStyles = [];
    $rowStyles = '';
    $rowClasses = '';
    $cellClasses = [];
    customDrawRow('parlamentarier', $rowData, $rowCellStyles, $rowStyles, $rowClasses, $cellClasses);

    $zbRet = zutrittsberechtigteForParlamentarier($con, $id, true);
    $zbList = $zbRet['zutrittsberechtigte'];
//         df($zbRet, '$zbRet');

    $mailtoParlam = 'mailto:' . rawurlencode($rowData["email"]) . '?subject=' . rawurlencode($emailSubjectParlam) . '&body=' . rawurlencode('[Kopiere von Vorlage]') . '&bcc=redaktion@lobbywatch.ch';

    $i = 0;
    foreach ($zbList as $zb) {

      $lang = $zb['arbeitssprache'];
      lobbywatch_set_language($lang);
      $lang_suffix = get_lang_suffix($lang);

      $emailSubjectZb[$i] = getSettingValue("zutrittsberechtigterAutorisierungEmailSubject$lang_suffix", false, 'Zugangsberechtigung ins Parlament');
      $emailIntroZb[$i] = StringUtils::ReplaceVariableInTemplate(getSettingValue("zutrittsberechtigterAutorisierungEmailEinleitung$lang_suffix", false, '[Einleitung]<br><br>Zutrittsberechtigung erhalten von %parlamentarierName%.'), 'parlamentarierName', $rowData["parlamentarier_name2"]);
      $emailEndZb[$i] = StringUtils::ReplaceVariableInTemplate(getSettingValue("zutrittsberechtigterAutorisierungEmailSchluss$lang_suffix", false, '<br><br>Freundliche Grüsse<br>%name%'), 'name', getFullUsername(Application::Instance()->GetCurrentUser()));

      $rowCellStylesZb[$i] = [];
      $rowStyles = '';
      customDrawRow('zutrittsberechtigung', $rowData, $rowCellStylesZb[$i], $rowStyles);

      $mailtoZb[$i] = 'mailto:' . rawurlencode($zb["email"]) . '?subject=' . rawurlencode($emailSubjectZb[$i]) . '&body=' . rawurlencode('[Kopiere von Vorlage]') . '&bcc=redaktion@lobbywatch.ch';

      $i++;
    }

    $lang = $parlamentarier_lang;
    lobbywatch_set_language($lang);
    $lang_suffix = get_lang_suffix($lang);

    // $organisationsbeziehungen = organisationsbeziehungen($con, $rowData["organisationen_from_interessenbindungen"]); RK Do not show Organisationsbeziehungen in Autorisierungs E-Mail, request Otto

//         ShowPreviewPage('<h4>Preview</h4><h3>' .$rowData["parlamentarier_name"] . '</h3>' .
//         '<h4>Interessenbindungen</h4><ul>' . $rowData['F'] . '</ul>' .
//         '<h4>Gäste</h4><ul>' . $rowData['zutrittsberechtigungen'] . '</ul>' .
//         '<h4>Mandate</h4><ul>' . $rowData['mandate'] . '</ul>');

    $state = '<table style="margin-top: 1em; margin-bottom: 1em;">
              <tr><td style="padding: 16px; '. $rowCellStyles['id'] . '" title="Status des Arbeitsablaufes dieses Parlamenteriers">Arbeitsablauf</td><td style="padding: 16px; '. $rowCellStyles['nachname'] . '" title="Status der Vollständigkeit der Felder dieses Parlamenteriers">Vollständigkeit</td></tr></table>';

//     $trans = lt('Ihre Interessenbindungen:');
//     df($trans);

    $viewData = new CommonPageViewData();
    $viewData->setTitle($rowData["parlamentarier_name"] . ' - Vorschau');
    DisplayTemplateSimple('custom_templates/parlamentarier_preview_page.tpl',
      array(
      ),
      array(
        'common' => $viewData,
        'App' => array(
          'ContentEncoding' => 'UTF-8',
          'PageCaption' => 'Vorschau: ' . $rowData["parlamentarier_name"],
          'Header' => GetPagesHeader(),
          'Direction' => 'ltr',
      ),
        'Footer' => GetPagesFooter(),
        'Parlamentarier' => array(
          'Id'  => $id,
          'Title' => 'Vorschau: ' . $rowData["parlamentarier_name"],
          'parlamentarier_name' => $rowData["parlamentarier_name"],
          'State' =>  $state,
          'Preview' => '<p><b>Beruf</b>: ' . $rowData['beruf'] . '</p>' .
            '<h4>Kommissionen</h4><ul>' . $rowData['kommissionen'] . '</ul>' .
            '<h4>Interessenbindungen</h4><ul>' . $rowData['interessenbindungen'] . '</ul>' .
            '<h4>Gäste' . (substr_count($rowData['zutrittsberechtigungen'], '[VALID_Zutrittsberechtigung]') > 2 ? ' <img src="img/icons/warning.gif" alt="Warnung">': '') . '</h4>' . ($rowData['zutrittsberechtigungen'] ? '<ul>' . $rowData['zutrittsberechtigungen'] . '</ul>': '<p>keine</p>') .
            '<h4>Mandate der Gäste</h4>' . $zbRet['gaesteMitMandaten'],
          'EmailTitle' => ($reAuthorization ? 'Re-' : '') . 'Autorisierungs-E-Mail: ' . '<a href="' . $mailtoParlam. '" target="_blank">' . $rowData["parlamentarier_name"] . '</a>',
          'EmailText' => '<div>' . $rowData['anrede'] . '' . $emailIntroParlam . (isset($rowData['beruf']) ? '<b>' . lt('Beruf:') . '</b> ' . translate_record_field($rowData, 'beruf', false, true) . '' : '') . '<br><br><b>' . lt('Ihre Interessenbindungen:') .'</b><ul>' . $rowData['interessenbindungen_for_email'] . '</ul>' .
            // $organisationsbeziehungen .  RK Do not show Organisationsbeziehungen in Autorisierungs E-Mail, request Otto
            '<b>' . lt('Ihre Gäste:') . '</b></p>' . ($rowData['zutrittsberechtigungen_for_email'] ? '<ul>' . $rowData['zutrittsberechtigungen_for_email'] . '</ul>': '<br>' . lt('keine') . '<br>') .
            '' . $emailEndParlam . '</div>',
            // '<p><b>Mandate</b> Ihrer Gäste:<p>' . gaesteMitMandaten($con, $id, true)
           'MailTo' => $mailtoParlam,
          'aemter' => $rowData['aemter'],
          'weitere_aemter' => $rowData['weitere_aemter'],
          'parlament_interessenbindungen' => $rowData['parlament_interessenbindungen'],
          'parlament_interessenbindungen_updated' => $rowData['parlament_interessenbindungen_updated_formatted'],
          'parlament_biografie_id' => $rowData['parlament_biografie_id'],
          'import_date_wsparlamentch' => $import_date_wsparlamentch,
        ),
        'Zutrittsberechtigter0' => fillZutrittsberechtigterEmail(0),
        'Zutrittsberechtigter1' => fillZutrittsberechtigterEmail(1),
        'Authentication' => array(
            'Enabled' => true,
            'LoggedIn' => GetApplication()->IsCurrentUserLoggedIn(),
            'CurrentUser' => array(
                'Name' => GetApplication()->GetCurrentUser(),
                'Id' => GetApplication()->GetCurrentUserId(),
            ),
        ),
        'HideSideBarByDefault' => true,
        'PageList' => getPageList()->GetViewData(),
        'Variables' => '',
      )
    );
} catch(Exception $e) {
    ShowErrorPage($e);
}
