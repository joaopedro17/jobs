<main>
    
    <h2 class="mt-3">Delete job</h2>
    <form method="post">
        <div class="form-group">
            <p>You sure that you want to delete this job? <strong>[<?=$newJob->title?>]</strong></p>
        </div>

            <div class="form-group">
                <a href="index.php">
                    <button type="button" class="btn btn-success">Cancel</button>
                </a>
                <button type="submit" name="delete" class="btn btn-danger">Confirm</button>
            </div>
        </div>
    </form>
</main>    