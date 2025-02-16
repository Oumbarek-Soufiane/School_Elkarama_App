<!DOCTYPE html>
<html>

<head>
    <title>Vos informations de connexion</title>
</head>

<body>

    <p>Bonjour,</p>
    <p>Voici vos informations de connexion pour {{ $teacher_first_name . ' ' . $teacher_last_name }} :</p>
    <p>Email : {{ $teacherEmail }}</p>
    <p>Mot de passe : {{ $teacherPassword }}</p>
    <p>Cordialement.</p>
</body>

</html>
