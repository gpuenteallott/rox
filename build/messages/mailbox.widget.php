<?php


class MailboxWidget extends ItemlistWithPagination
{
    public function render() {
        parent::render(); 
    }
    
    // pagination
    
    protected function hrefPage($i_page) {
        return 'messages/inbox/'.$i_page;
    }
    
    
    //-----------------------------------------------------------------
    // getting the items
    
    protected function getAllItems()
    {
        return $this->getMessages();
    }
    
    
    //-----------------------------------------------------------------
    // table layout
    
    /**
     * Columns for messages table.
     * The $key of a column is used as a suffix for method tableCell_$key
     *
     * @return array table columns, as $name => Column title
     */
    protected function getTableColumns()
    {
        return array(
            'contact' => 'From/To',
            'title' => 'Text',
            'dateSent' => 'Date',
        );
    }
    
    /**
     * Table cell in column 'contact', for the given $message
     *
     * @param unknown_type $message
     */
    protected function tableCell_contact($message)
    {
        $direction_in = ($message->IdReceiver == $_SESSION['IdMember']);
        $contact_username = $direction_in ? $message->senderUsername : $message->receiverUsername;
        $contact_id = $direction_in ? $message->IdSender : $message->IdReceiver;
        $read = (int)$message->WhenFirstRead;
        ?>
        <a href="" id="<?=$message->id?>" class="msganchor"></a>
        <table><tr>
        <td><?//=MOD_layoutbits::linkWithPicture($contact_username) ?>
        <input type="checkbox" name="message-mark[]" value="<?=$message->id?>" />
        </td>
        <td>
        <a href="messages/with/<?=$contact_username ?>"><img src="images/icons/dir_<?=$read ? 'read_' : '' ?><?=$direction_in ? 'right' : 'left' ?>.png" alt="<?=$direction_in ? 'From' : 'To' ?>" title="<?=$direction_in ? 'From' : 'To' ?>"></a>
        </td>
        <td><?//=MOD_layoutbits::linkWithPicture($contact_username) ?>
        <a href="bw/member.php?cid=<?=$contact_username ?>"><?=MOD_layoutbits::PIC_30_30($contact_username,'',$style='float_left')?></a>
        </td>
        </tr></table><?php
    }
    
    protected function tableCell_title($message)
    {
        $direction_in = ($message->IdReceiver == $_SESSION['IdMember']);
        $contact_username = $direction_in ? $message->senderUsername : $message->receiverUsername;
        ?>
        <a style="color: #333; font-size: 14px" href="messages/with/<?=$contact_username ?>"><strong><?=$contact_username ?></strong></a>
        <br /><a class="text" style="color: #999" href="messages/<?=$message->id ?>"><?=(strlen($message->Message) >= 150) ? substr($message->Message,0,150).' ...' : $message->Message ?></a>
        <?php
    }
    
    protected function tableCell_dateSent($message)
    {
        $direction_in = ($message->IdReceiver == $_SESSION['IdMember']);
        $date_sent = $message->DateSent;
        $date_created = $message->created;
        $date_string = date("M d, Y - H:i",strtotime($date_created));
        ?>
        <span style="color:silver; font-size:80%"><?=$direction_in ? 'Received on' : 'Sent on' ?></span><br>
        <?=$date_string ?>
        <?php
    }
    
    protected function tableCell_action($message)
    {
        $direction_in = ($message->IdReceiver == $_SESSION['IdMember']);
        $contact_username = $direction_in ? $message->senderUsername : $message->receiverUsername;
        $contact_id = $direction_in ? $message->IdSender : $message->IdReceiver;
        ?>
        <a href="messages/with/<?=$contact_username ?>"><img src="images/icons/comments.png" alt="conversation with <?=$contact_username ?>" title="conversation with <?=$contact_username ?>"></a>
        <a href="messages/compose/<?=$contact_username ?>"><img src="images/icons/icons1616/icon_contactmember.png" alt="new message" title="new message"></a>
        <?php
    }
    
}


?>
