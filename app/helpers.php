<?php

   function flash_session ($message, $status = 'success'){
       session()->flash('status-message', $message);
       session()->flash('status', $status);
    }