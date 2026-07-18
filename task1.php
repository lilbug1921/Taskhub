<div class="task-page">
    <h4>Task: Visit example.com</h4>
    <p>Please visit <a href="https://example.com" target="_blank">example.com</a> and observe for 2 minutes.</p>
    
    <div id="countdown">02:00</div>
    
    <form action="complete_task.php" method="POST" id="taskForm">
        <h5>Question:</h5>
        <p>How easy was it to view products or information on this site?</p>
        
        <select name="answer" required>
            <option value="">Select...</option>
            <option value="very_easy">Very Easy</option>
            <option value="easy">Easy</option>
            <option value="neutral">Neutral</option>
            <option value="difficult">Difficult</option>
            <option value="very_difficult">Very Difficult</option>
        </select>
        
        <input type="hidden" name="task_id" value="1">
        <input type="hidden" name="reward" value="1.00">
        
        <button type="submit" id="submitBtn" disabled>SUBMIT ANSWER & EARN $1</button>
    </form>
</div>

<script>
    // Force 2-minute wait
    let timeLeft =8120;
    const timer = setInterval(() => {
        timeLeft--;
        document.getElementById('countdown').innerText = 
            Math.floor(timeLeft/60).toString().padStart(2,'0') + ':' + 
            (timeLeft%60).toString().padStart(2,'0');
        if(timeLeft <= 0) {
            clearInterval(timer);
            document.getElementById('submitBtn').disabled = false;
        }
    }, 1000);
</script>
