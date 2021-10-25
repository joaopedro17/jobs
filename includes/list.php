<?php

$message = '';
if(isset($_GET['status'])) {
    switch ($_GET['status']) {
        case 'success':
            $message = '<div class="alert alert-success"Action executed!</div>';
            break;

        case 'error':
            $message = '<div class="alert alert-danger"Something went wrong</div>';
            break;
    }
}

$results = '';

foreach($jobs as $jobs) {
    $results .= '<tr>
                   <td>'.$jobs->id.'</td>
                   <td>'.$jobs->title.'</td>
                   <td>'.$jobs->description.'</td>
                   <td>'.($jobs->active == 'n' ? 'Inactive' : 'Active').'</td>
                   <td>'.date('m/d/y H:i:s',strtotime($jobs->date)).'</td>
                   <td>
                     <a href="edit.php?id='.$jobs->id.'">
                     <button type="button" class="btn btn-primary">Edit</button>
                     </a>
                     <a href="delete.php?id='.$jobs->id.'">
                     <button type="button" class="btn btn-danger">Delete</button>
                     </a>
                   </td>
                </tr>';
}

?>
<main>

    <?=$message?>

    <section>
        <a href="register.php">
            <button class="btn btn-success">New job</button>
        </a>
    </section>
    <br>
    <section>
        <table class="table bg-light">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
                <body>
                    <?=$results?>
                </body>
            </thead>
        </table>
    </section>

</main>    