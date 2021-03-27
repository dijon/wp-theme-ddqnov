<?php
/**
 * Template Name: Contact Us
 */

$humanData = [
        [2, 'три', 'пет'],
        [6, 'пет', 'единадесет'],
        [45, 'единадесет', 'петдесет и шест'],
        [108, 'сто деветдесет и три', 'триста и едно'],
    ];

$captcha = $humanData[array_rand($humanData)];
//response generation function
$response = '';

//function to generate response
function my_contact_form_generate_response($type, $message){
    global $response;

    if ($type == "success") {
        $response = "<div class=\"alert alert-success\" role=\"alert\">{$message}</div>";
    } else {
        $response = "<div class=\"alert alert-danger\" role=\"alert\">{$message}</div>";
    }
}

//response messages
$not_human       = "Ти не си човек, момче!";
$missing_content = "Моля, попълнете всичките полета.";
$email_invalid   = "Email адреса е невалиден.";
$message_unsent  = "Съобщението не беше изпратено, опитайте отново.";
$message_sent    = "Съобщението беше изпратено успешно";

//user posted variables
$name = $_POST['message_name'];
$email = $_POST['message_email'];
$message = $_POST['message_text'];
$human = $_POST['message_human'];

if ($human != $_SESSION['human'][0]) {
    $_SESSION['human'] = $captcha;
}

//php mailer variables
$to = get_option('admin_email');
$subject = "Someone sent a message from ".get_bloginfo('name');
$headers = 'From: '. $email . "\r\n" .
    'Reply-To: ' . $email . "\r\n";

if (!$human == 0) {
    if ($human != $_SESSION['human'][0]) {
        my_contact_form_generate_response("error", $not_human); //not human!
    } else {
        //validate email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            my_contact_form_generate_response("error", $email_invalid);
        } else { //email is valid
            //validate presence of name and message
            if (empty($name) || empty($message)) {
                my_contact_form_generate_response("error", $missing_content);
            } else {
                // send mail
                if (wp_mail($to, $subject, strip_tags($message), $headers)) {
                    my_contact_form_generate_response("success", $message_sent);
                    unset($_POST);
                } else {
                    my_contact_form_generate_response("error", $message_unsent);
                }
            }
        }
    }
} else if ($_POST['submitted']) {
    my_contact_form_generate_response("error", $missing_content);
}

get_header(); ?>

<main class="container">
    <div class="row">
        <div class="col-md-8">

            <?php while ( have_posts() ) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class("blog-post"); ?>>
                <h2 class="blog-post-title"><?php the_title();?></h2>

                <?php the_content(); ?>

                <div>
                    <?php echo $response; ?>
                    <form action="<?php the_permalink(); ?>" method="post" class="row g-3 needs-validation" novalidate>
                        <div class="form-floating mb-3">
                            <input type="text" id="name" class="form-control" placeholder="Бай Иван" name="message_name"
                                   value="<?php echo esc_attr($_POST['message_name']); ?>" required>
                            <label for="name">Име</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="email" placeholder="name@example.com" name="message_email"
                                   value="<?php echo esc_attr($_POST['message_email']); ?>" required>
                            <label for="email">Email адрес</label>
                        </div>
                        <div class="form-floating mb-3">
                            <textarea class="form-control" id="message" rows="5" name="message_text" style="height: 180px;"
                            required><?php echo esc_textarea($_POST['message_text']); ?></textarea>
                            <label for="message">Съобщение</label>
                        </div>

                        <label for="message_human" class="form-label">Човешка проверка (напишете с арабско число)</label>
                        <div class="input-group mb-3 mt-0">
                            <input type="text" class="form-control" id="human" name="message_human" required autocomplete="off">
                            <span class="input-group-text" id="human"> плюс &nbsp;
                                <strong><?php echo $captcha[1]; ?></strong> &nbsp; е равно на &nbsp;
                                <strong><?php echo $captcha[2]; ?></strong>.</span>
                        </div>

                        <input type="hidden" name="submitted" value="1">
                        <div class="col-12">
                            <button class="btn btn-primary" type="submit">Изпрати</button>
                        </div>
                    </form>
                </div>

                <?php endwhile; // end of the loop. ?>
            </article>
        </div>
        <?php get_sidebar(); ?>
    </div><!-- /.row -->
</main><!-- /.container -->

<?php get_footer(); ?>