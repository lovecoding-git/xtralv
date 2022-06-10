class redhook_gaa_adduserinformationtemplate extends skin_register(~id~) {
    public function registerShowTerms($text='',$coppa_user='') {
        $settings = $this->registry->fetchSettings();
        $additionaltext = $settings['redhook_gaa_informtext'];

        if ( !empty( $additionaltext ) ) {
            $text .= '<br /><br />' . $additionaltext;
        }

        return parent::registerShowTerms( $text, $coppa_user );
    }
}
