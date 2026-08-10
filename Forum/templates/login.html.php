<h2>Login</h2>

<div class="login-wrapper">
    
    <div class="login-student">
        <h3>Student Login</h3>

        <?php if (!empty($error_student)): ?>
            <p class="message message-error">
                <?=$error_student?>
            </p>
        <?php endif; ?>

        <form action="" method="post">
            <label for="student_email">Email</label>
            <input type="email" name="student_email" id="student_email" required>

            <label for="student_password">Password</label>
            <input type="password" name="student_password" id="student_password" required>

            <div class="login-actions">
                <input type="submit" value="Login">

                
                <button type="button" class="admin-area-button" onclick="openAdminPopup()">
                    Admin Area
                </button>
            </div>
        </form>
    </div>
</div>


<div id="admin-popup-overlay" class="admin-popup-overlay" style="display:none;">
    <div class="admin-popup">
        <h3>Admin Login</h3>

        <?php if (!empty($error_admin)): ?>
            <p class="message message-error">
                <?=$error_admin?>
            </p>
        <?php endif; ?>

        <form action="" method="post">
            <label for="admin_password">Password</label>
            <input type="password" name="admin_password" id="admin_password" required>

            <div class="login-actions">
                <input type="submit" value="Confirm">
                <button type="button" onclick="closeAdminPopup()">Cancel</button>
            </div>
        </form>
    </div>
</div>