
<div class="card-block">
    <div class="right-icon-control">
        <input type="text" class="form-control  search-text" placeholder="Search Friend">
        <div class="form-icon">
            <i class="icofont icofont-search"></i>
        </div>
    </div>
</div>
<?php $recentChats = getAdRelatedChats(); 
if (!empty($this->session->userdata('employee'))) {
    $user = $this->session->userdata('employee');
}else{
    $user = $this->session->userdata('employer');
}
if (!empty($recentChats) && !empty($this->session->userdata('employee'))) { 
    $count = 0; ?>
    <div class="card-block">
        <h5>Ad Related Chats</h5>
    </div>
    <?php 
    foreach ($recentChats as $chats) {
        if ($chats['chat_from'] == $user['user_id']) {
            $dataID = $chats['chat_to'];
        }else{
            $dataID = $chats['chat_from'];
        }
        if ($chats['chat_from'] == $user['user_id']) {
            $chatUsername = ucwords($chats['username_other']);
        }else{
            $chatUsername = ucwords($chats['username']);
        }
        $detail = getAgreementDetail($dataID,$chats['chat_post']);
        if (!empty($detail)) {
            if ($detail['employee_id'] != $user['user_id']) {
                continue;
            }
        }
        $detail = getAgreementDetail($user['user_id'],$chats['chat_post']);
        if (!empty($detail)) {
            if ($detail['employee_id'] != $dataID) {
                continue;
            }
        }
        $count++;
        ?>
        <div class="media userlist-box" data-id="<?php echo $dataID; ?>" data-status="online" data-username="<?php echo $chatUsername; ?>" data-post="<?php echo $chats['chat_post']; ?>">
            <a class="media-left" href="javascript:void(0)">
                <?php 
                if ($chats['chat_from'] == $user['user_id']) {
                    if (!empty($chats['picture_other'])) {
                        $src = base_url()."uploads/profile_avatar/".$chats['picture_other'];
                    }else{
                        $src = base_url()."assets/images/no-image.png";
                    }
                }else{
                    if (!empty($chats['picture'])) {
                        $src = base_url()."uploads/profile_avatar/".$chats['picture'];
                    }else{
                        $src = base_url()."assets/images/no-image.png";
                    }
                } ?>
                <img class="media-object img-circle" src="<?php echo $src; ?>" alt="User">
                <div class="live-status bg-success"></div>
            </a>
            <div class="media-body">
                <div class="f-13 chat-header">
                    <?php if ($chats['chat_from'] == $user['user_id']) {
                        echo ucwords($chats['username_other']);
                    }else{
                        echo ucwords($chats['username']);
                    } ?>
                </div>
                <?php echo ucfirst($chats['ad_title']); ?>
                <p class="text-muted">
                    <?php 
                    $lastMessage = getLastMessage($chats['chat_post'], $dataID);
                    if ($lastMessage['chat_read'] == 0 && $lastMessage['chat_from'] != $user['user_id']) { ?>
                        <strong><?php echo custom_substr($lastMessage['message'], 20); ?></strong> 
                    <?php }else{
                        echo custom_substr($lastMessage['message'], 20); 
                    }
                    ?>
                    <br>
                    <?php $time = covertTimeStampToHourMinutes($lastMessage['sent']);
                    echo $time; ?>
                </p>
            </div>
        </div>
    <?php }
    if ($count == 0) { ?>
        <div class="media">
            <div class="media-body">
                <div class="f-13 chat-header">No ad related chat found!</div>
            </div>
        </div>
    <?php }
}else if(empty($recentChats) && !empty($this->session->userdata('employee'))){?>
    <div class="card-block">
        <h5>Ad Related Chats</h5>
    </div>
    <div class="media">
        <div class="media-body">
            <div class="f-13 chat-header">No ad related chat found!</div>
        </div>
    </div>
<?php } ?>
<div class="card-block">
    <h5>Recent Chats</h5>
</div>
<?php $recentChats = getRecentChats(); 
if (!empty($recentChats)) { ?>
    <?php 
    if (!empty($this->session->userdata('employee'))) {
        $user = $this->session->userdata('employee');
    }else{
        $user = $this->session->userdata('employer');
    }
    foreach ($recentChats as $chats) {
        if ($chats['chat_from'] == $user['user_id']) {
            $dataID = $chats['chat_to'];
        }else{
            $dataID = $chats['chat_from'];
        }
        if ($chats['chat_from'] == $user['user_id']) {
            $chatUsername = ucwords($chats['username_other']);
        }else{
            $chatUsername = ucwords($chats['username']);
        }
        ?>
        <div class="media userlist-box" data-id="<?php echo $dataID; ?>" data-status="online" data-username="<?php echo $chatUsername; ?>" data-post="<?php echo $chats['chat_post']; ?>">
            <a class="media-left" href="javascript:void(0)">
                <?php 
                if ($chats['chat_from'] == $user['user_id']) {
                    if (!empty($chats['picture_other'])) {
                        $src = base_url()."uploads/profile_avatar/".$chats['picture_other'];
                    }else{
                        $src = base_url()."assets/images/no-image.png";
                    }
                }else{
                    if (!empty($chats['picture'])) {
                        $src = base_url()."uploads/profile_avatar/".$chats['picture'];
                    }else{
                        $src = base_url()."assets/images/no-image.png";
                    }
                } ?>
                <img class="media-object img-circle" src="<?php echo $src; ?>" alt="User">
                <div class="live-status bg-success"></div>
            </a>
            <div class="media-body">
                <div class="f-13 chat-header">
                    <?php if ($chats['chat_from'] == $user['user_id']) {
                        echo ucwords($chats['username_other']);
                    }else{
                        echo ucwords($chats['username']);
                    } ?>
                </div>
                <?php echo ucfirst($chats['ad_title']); ?>
                <p class="text-muted">
                    <?php 
                    $lastMessage = getLastMessage($chats['chat_post'], $dataID);
                    if ($lastMessage['chat_read'] == 0 && $lastMessage['chat_from'] != $user['user_id']) { ?>
                        <strong><?php echo custom_substr($lastMessage['message'], 20); ?></strong> 
                    <?php }else{
                        echo custom_substr($lastMessage['message'], 20); 
                    }
                    ?>
                    <br>
                    <?php $time = covertTimeStampToHourMinutes($lastMessage['sent']);
                    echo $time; ?>
                </p>
            </div>
        </div>
    <?php }
}else{?>
    <div class="media">
        <div class="media-body">
            <div class="f-13 chat-header">No recent chat found!</div>
        </div>
    </div>
<?php } ?>
