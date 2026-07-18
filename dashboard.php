<div class="dashboard">
    <!-- Balance Display -->
    <div class="balance-box">
        <h4>Your Balance: <span id="balance">$25.00</span></h4>
        <button onclick="showRedeem()" class="btn btn-warning">💳 REDEEM</button>
    </div>
    
    <!-- Task List -->
    <div class="task-list">
        <h3>Available Tasks ($1 each)</h3>
        
        <!-- Task 1 -->
        <div class="task-card">
            <h5>Visit example.com</h5>
            <p>Observe for 2 minutes, then return and answer question.</p>
            <a href="task1.php" class="btn btn-primary">START TASK</a>
        </div>
        
        <!-- Task 2 (randomized) -->
        <div class="task-card">
            <h5>Visit amazon.com</h5>
            <p>Browse for 2 minutes, then answer question.</p>
            <a href="task2.php" class="btn btn-primary">START TASK</a>
        </div>
        
        <!-- More tasks (20+ total) -->
    </div>
</div>

<!-- Redeem Popup -->
<div id="redeemModal" style="display:none;">
    <div class="modal-content">
        <h4>💰 Redeem Earnings</h4>
        <p>When your balance reaches <strong>$50</strong>, you may redeem.</p>
        <p>Send redemption inquiries along with your email address and name to:</p>
        <p><strong>railwaypayments@gmail.com</strong></p>
        <button onclick="hideRedeem()">CLOSE</button>
    </div>
</div>
