<?php


/**
 * Page for inviting a friend
 * 
 * @package inviteafriend
 * @author Micha (lupochen)
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License (GPL)
 * @version $Id$
 */
class InvitePage extends RoxPageView
{

    protected function teaserContent() {
        // &gt; or &raquo; ?
        $username = isset($_SESSION['Username']) ? $_SESSION['Username'] : 'Nobody';
        ?><div id="teaser" class="clearfix">
        <div id="teaser_l1"> 
        <h1>Invite a friend</h1>
        </div>
        </div><?php
    }

    /**
     * content of the middle column - this is the most important part
     */
    protected function column_col3()
    {
        // get translation module
        $layoutkit = $this->layoutkit;
        $words = $layoutkit->getWords();
        $model = $this->getModel();
        
        $page_url = PVars::getObj('env')->baseuri . implode('/', PRequest::get()->request);
        
        $formkit = $layoutkit->formkit;
        $callback_tag = $formkit->setPostCallback('InviteController', 'InviteCallback');
        
        // defaults
        $email = '';
        $subject = $words->get("MailInviteAFriendSubject", 'FULL NAME',$_SESSION['Username']);
        $urltosignup = PVars::getObj('env')->baseuri.'bw/signup.php';
        $text = str_replace('<br />','',$words->getFormatted('InviteAFriendStandardText','<a href="http://www.bewelcome.org/bw/member.php?cid='.$_SESSION["Username"].'">'.$_SESSION["Username"].'</a>',$urltosignup));
        $attach_picture = '';
        
        if (!$memory = $formkit->getMemFromRedirect()) {
            // no memory
        } else {
            // from previous form
            if ($memory->post) {
                if (isset($memory->post['email'])) {
                    $email = $memory->post['email'];
                }
                if (isset($memory->post['subject'])) {
                    $subject = $memory->post['subject'];
                }
                if (isset($memory->post['text'])) {
                    $text = $memory->post['text'];
                }
                if (isset($memory->post['attach_picture'])) {
                    $attach_picture = ' checked';
                }
            }
            
            if ($memory->expired) {
                ?>your session has expired while you were typing. Try again?<?php
            } else if ($memory->already_sent_as) {
                if ($message = $this->getModel()->getMessage($memory->already_sent_as)) {
                    ?><p>Looks like you've already sent this message as</p>
                    <p><i><?=$message->Message ?></i></p>
                    <p>Do you want to send again with the modified text below?</p>
                    <?php
                } else {
                    ?>looks like you've already sent this message, but system can't find it. Send again?<?php
                }
            }
            
            // problems from previous form
            if (is_array($memory->problems)) {
                $problems = $memory->problems;
            }
        }
        
        require_once 'templates/compose.php';
    }
    
    protected function getFieldValues()
    {
        $field_values = array(
            'message_id' => 0,
            'receiver_id' => $this->_recipient->id, 
            'text' => 'type something'
        );
        
        return $field_values;
    }
}

/**
 * Page for inviting a friend
 * 
 * @package inviteafriend
 * @author Micha (lupochen)
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License (GPL)
 * @version $Id$
 */
class InviteSentPage extends RoxPageView
{

    protected function teaserContent() {
        // &gt; or &raquo; ?
        $username = isset($_SESSION['Username']) ? $_SESSION['Username'] : 'Nobody';
        ?><div id="teaser" class="clearfix">
        <div id="teaser_l1"> 
        <h1>Invite a friend</h1>
        </div>
        </div><?php
    }

    /**
     * content of the middle column - this is the most important part
     */
    protected function column_col3()
    {
        // get translation module
        $layoutkit = $this->layoutkit;
        $words = $layoutkit->getWords();
        echo '
        <p class="note big"><img src="images/icons/accept.png" class="float_left"> Your invitation has been sent. Do you want to <a href="invite">invite more friends</a>?
        
        </p>'
        ;
        
    }
    
}



?>