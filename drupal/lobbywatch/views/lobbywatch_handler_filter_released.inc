<?php

/**
 * @file
 * Definition of lobbywatch_handler_filter_freigabe_datum.
 */

/**
 * Filter by published lobbywatch content or admin.
 *
 * @ingroup views_filter_handlers
 */
class lobbywatch_handler_filter_released extends views_handler_filter {
  function admin_summary() { }
  function operator_form(&$form, &$form_state) { }
  function can_expose() { return FALSE; }

  function query() {
    $table = $this->ensure_my_table();
    $this->query->add_where_expression($this->options['group'], "$table.freigabe_datum <= NOW()");
  }
}