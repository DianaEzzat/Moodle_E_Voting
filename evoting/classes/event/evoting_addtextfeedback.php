<?php

namespace mod_evoting\event;

defined('MOODLE_INTERNAL') || die();

class evoting_addtextfeedback extends \core\event\base {
    /**
     * Init method.
     *
     * @return void
     */
    protected function init() {
        $this->data['crud'] = 'u';
        $this->data['edulevel'] = self::LEVEL_PARTICIPATING;
        $this->data['objecttable'] = 'evoting_feedback';
    }

    /**
     * Returns description of what happened.
     *
     * @return string
     */
    public function get_description() {
        return get_string('eventevotinguserid', 'mod_evoting') .  ' ' . $this->userid . ' ' . get_string('eventevotingobjectidfeedback', 'mod_evoting') . ' ' . $this->objectid . ' ' . get_string('eventusercontextid', 'mod_evoting') . ' ' .$this->contextinstanceid;
    }

    /**
     * Return localised event name.
     *
     * @return string
     */
    public static function get_name() {
        return get_string('eventevotingfeedback', 'mod_evoting');
    }

    /**
     * Get URL related to the action
     *
     * @return \moodle_url
     */
    public function get_url() {
        return new \moodle_url('/mod/evoting/view.php', array('id' => $this->contextinstanceid));
    }

    /**
     * Return the legacy event log data.
     *
     * @return array|null
     */
    protected function get_legacy_logdata() {
        $logurl = substr($this->get_url()->out_as_local_url(), strlen('/mod/evoting/'));

        return array($this->courseid, 'evoting_feedback', 'Feedback evoting', $logurl, $this->contextinstanceid);
    }

    /**
     * Custom validation.
     *
     * @throws \coding_exception
     * @return void
     */
    protected function validate_data() {
        parent::validate_data();
    }

    public static function get_objectid_mapping() {
        return array('db' => 'evoting_questions', 'restore' => 'evoting_feedback');
    }

}
