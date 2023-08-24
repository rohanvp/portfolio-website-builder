<?php
include 'dbconnect.php';

function MetaDetailsUsername($conn)
{
    $meta_details_query = "SELECT c1, c2 FROM meta_details WHERE c1='user-name'";
    $user_name = mysqli_fetch_assoc($conn->query($meta_details_query));
    return $user_name;
}

function SectionOrder($conn)
{
    $section_order_query="SELECT * FROM section_details WHERE section_order!=-1 ORDER BY section_order";
    $section_order_rows =mysqli_query($conn, $section_order_query);
    
    $section_order_arr=array();

    while($row = mysqli_fetch_assoc($section_order_rows))
    {   
        $section_order_arr[$row["section_order"]]=$row["section_name"];
    }

    return $section_order_arr;

}

function MetaDetailsDescription($conn)
{
    $meta_details_query = "SELECT c2 FROM meta_details WHERE c1='meta-description'";
    $meta_description = mysqli_query($conn, $meta_details_query);
  
    while($row = $meta_description->fetch_assoc()) {
        $res=$row["c2"];
      }
    return $res;
}

function LoadLinkedinLink($conn)
{
    $meta_details_query = "SELECT c2 FROM meta_details WHERE c1='linkedin_link'";
    $result = $conn->query($meta_details_query);

    while($row = $result->fetch_assoc()) {
        $res=$row["c2"];
      }

    return $res;
}

function LoadGithubLink($conn)
{
    $meta_details_query = "SELECT c2 FROM meta_details WHERE c1='github_link'";
    $result = $conn->query($meta_details_query);

    while($row = $result->fetch_assoc()) {
        $res=$row["c2"];
      }
      
    return $res;
}

function LoadPersonalWebsiteLink($conn)
{
    $meta_details_query = "SELECT c2 FROM meta_details WHERE c1='personal_website_link'";
    $result = $conn->query($meta_details_query);

    while($row = $result->fetch_assoc()) {
        $res=$row["c2"];
      }
      
    return $res;
}

function LoadFooterDescription($conn)
{
    $meta_details_query = "SELECT c2 FROM meta_details WHERE c1='footer_description'";
    $result = $conn->query($meta_details_query);

    while($row = $result->fetch_assoc()) {
        $res=$row["c2"];
      }
      
    return $res;
}

function LoadFooterAddress($conn)
{
    $meta_details_query = "SELECT c2 FROM meta_details WHERE c1='footer_address'";
    $result = $conn->query($meta_details_query);

    while($row = $result->fetch_assoc()) {
        $res=$row["c2"];
      }
      
    return $res;
}

function LoadFooterEmail($conn)
{
    $meta_details_query = "SELECT c2 FROM meta_details WHERE c1='footer_email'";
    $result = $conn->query($meta_details_query);

    while($row = $result->fetch_assoc()) {
        $res=$row["c2"];
      }
      
    return $res;
}
?>