<?php
class Validation
{
    //validate the name and surname for injection and set the first letter to uppercase
    public static function validateData($data)
    {
        $data = strip_tags($data);
        $data = str_replace(" ","",$data);
        $data = strtolower($data);
        $data = ucfirst($data);

        return $data;
    }

    //validate the email and set it to lowercase
    public static function validateEmail($email)
    {
        $email = strip_tags($email);
        $email = str_replace(" ","",$email);
        $email = strtolower($email);
        if(!filter_var($email, FILTER_VALIDATE_EMAIL))
		{
			Echo " Invalid email format!";
			
		}
        return $email;
    }
}


?>