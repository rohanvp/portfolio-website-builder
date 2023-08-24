<?php
include 'load_page_sections.php';
$user_name=MetaDetailsUsername($conn);
$section_order_array=SectionOrder($conn);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="<?php echo MetaDetailsDescription($conn);?>">
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <title><?php echo $user_name["c2"];?> Website</title>

  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Fira+Code:wght@300&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

  <link rel="icon" href="">
  <link rel="stylesheet" href="style.css" />
</head>

<body>
  <header>
    <?php LoadNavbar($conn,$user_name);?>
  </header>


  
  <!-- SIDEBAR -->
  <div class="left-bar">
    <ul class="list-unstyled">
      <li class="mb-5 mt-5">
        <a href="<?php echo $linkedin_link;?>" target="_blank"><i
            class="fa-brands fa-linkedin fa-2xl"></i>
        </a>
      </li>
      <li class="mb-5 mt-5">
        <a href="<?php echo $github_link;?>" target="_blank"><i class="fa-brands fa-github fa-2xl sidebar-github"></i>
        </a>
      </li>
    </ul>
  </div>

  <?php
    $section_order_array=SectionOrder($conn);

    foreach ($section_order_array as $key => $value) {

      if($value=='hero')
      {
        LoadHeroSection($conn,$user_name);
      }
      elseif($value=='about')
      {
        LoadAboutMe($conn,$user_name);
      }
      elseif($value=='projects')
      {
        LoadProjectSection($conn,$user_name,$github_link);
      }
      elseif($value=='experience')
      {
        LoadExperienceSection($conn,$user_name);
      }
      elseif($value=='footer')
      {
        LoadFooterSection($conn,$user_name,$linkedin_link,$github_link,$personalwebsite_link);
      }

    }

  ?>

  
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

</html>