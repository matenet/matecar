<?php

             if ($this->session->userdata('user_id')):
                    redirect('zaplecze');
                    endif; ?>
                    <h3>Podaj swój e-mail i hasło:</h3>
                    <?php echo form_open(); ?>
                        <input type="email" id="email" class="login-field" name="email" placeholder="Email">
                        <input type="password" id="password" class="login-field" name="password" placeholder="Hasło">
                        <button type="submit" name="submit" class="submit-button">Zaloguj</button>
                    <?php echo form_close(); ?>
</div>
