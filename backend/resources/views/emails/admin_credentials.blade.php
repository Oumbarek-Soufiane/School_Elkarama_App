<!DOCTYPE html>
<html>

<head>
    <title>Vos informations de connexion</title>
</head>

<body>

    <p>Bonjour,</p>
    <p>Voici vos informations de connexion {{ $adminFirstName . ' ' . $adminLastName }} :</p>
    <p>Email : {{ $adminEmail }}</p>
    <p>Mot de passe : {{ $adminPassword }}</p>
    <p>Cordialement.</p>
</body>

</html>
