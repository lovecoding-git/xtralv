<?php
/**
 * (RedHook) Google Analytics Advanced
 *
 * Google Analytics code insert hook for
 * Invision Power Board 3.1.2
 *
 * @author Bernhard Rosenberger
 * @copyright Rosenberger & Zotter OG
 * @link http://www.redenzian.at, http://www.ip-me.at
 * @version 1.0.0
 */
class redhook_gaa_insertgoogleanalyticscode {

    /**
     * The Registry Object
     * @var object
     */
    private $registry;
    /**
     * The Member object
     * @var object
     */
    private $member;

    /**
     * The Settings
     * @var array
     */
    private $settings;

    /**
     * getOutput()
     * Process the data and return output
     *
     * @since 1.0.0
     * @return string
     */
    public function getOutput() {
        $this->registry = ipsRegistry::instance();
        $this->settings = $this->registry->fetchSettings();
        $this->member = ipsRegistry::instance()->member()->fetchMemberData();

        // Check the Tracking ID first
        if ( empty( $this->settings['redhook_gaa_trackingid'] ) ) {
            return '';
        }

        // Check Usergroup and names excludes
        if ( !empty( $this->settings['redhook_gaa_groupsdonottrack'] ) ) {
            $excludedgroups = explode( ',', $this->settings['redhook_gaa_groupsdonottrack'] );
            if ( in_array($this->member['member_group_id'], $excludedgroups ) ) {
                return '';
            }
        }

        if ( !empty( $this->settings['redhook_gaa_usersdonottrack'] ) ) {
            $users = strtolower($this->settings['redhook_gaa_usersdonottrack'] );
            $excludedusers = explode( ',', $users );
            if ( in_array( $this->member['members_l_username'], $excludedusers ) ||
                 in_array( $this->member['members_l_display_name'], $excludedusers ) ) {
                return '';
            }
        }

        // Get the analytics code and return it
        switch( $this->settings['redhook_gaa_trackingtype'] ) {
            case '3':
                return $this->getMultiTLDDomainTemplate( $this->settings['redhook_gaa_trackingid'] );
                break;
            case '2':
                // Check if we have a domain name
                if ( empty( $this->settings['redhook_gaa_domainname'] ) ) {
                    return $this->getSingleDomainTemplate( $this->settings['redhook_gaa_trackingid'] );
                }
                $domain = substr( $this->settings['redhook_gaa_domainname'], 0, 1 ) == '.' ? strtolower( $this->settings['redhook_gaa_domainname'] ) : '.' . strtolower( $this->settings['redhook_gaa_domainname'] );
                return $this->getSingleDomainWithSubdomainsTemplate( $this->settings['redhook_gaa_trackingid'], $domain);
                break;
            case '1':
            default:
                return $this->getSingleDomainTemplate( $this->settings['redhook_gaa_trackingid'] );
                break;
        }
    }

    /**
     * getSingleDomainTemplate()
     * The JS Code for a single domain tracking
     *
     * @since 1.0.0
     * @param string $trackingid
     * @return string
     */
    private function getSingleDomainTemplate( $trackingid ) {
        return <<<HTML
<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', '{$trackingid}']);
  _gaq.push(['_trackPageview']);
  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>
HTML;
    }

    /**
     * getSingleDomainWithSubdomainsTemplate()
     * The JS Code for a single domain with multiple subdomains tracking
     *
     * @since 1.0.0
     * @param string $trackingid
     * @param string $domain
     * @return string
     */
    private function getSingleDomainWithSubdomainsTemplate( $trackingid, $domain ) {
        return <<<HTML
<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', '{$trackingid}']);
  _gaq.push(['_setDomainName', '{$domain}']);
  _gaq.push(['_trackPageview']);
  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>
HTML;
    }

    /**
     * getMultiTLDDomainTemplate()
     * The JS Code for a multidomain tracking setup
     *
     * @since 1.0.0
     * @param string $trackingid
     * @return string
     */
    private function getMultiTLDDomainTemplate( $trackingid ) {
        return <<<HTML
<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', '{$trackingid}']);
  _gaq.push(['_setDomainName', 'none']);
  _gaq.push(['_setAllowLinker', true]);
  _gaq.push(['_trackPageview']);
  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>
HTML;
    }
}