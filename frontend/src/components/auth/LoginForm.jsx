import React, { Fragment } from "react";
import { Form } from "react-router-dom";
import Input from "./../UI/inputs/Input";
import Button from "../UI/buttons/Button";
import { IoMdLogIn } from "react-icons/io";

function LoginForm() {
  return (
    <Fragment>
      <Form method="POST">
        <Input label="Email" type="email" name="email" required />
        <Input label="Mot de passe" type="password" name="password" required />
        <Button
          text="Se connecter"
          type="submit"
          className="fw-bold float-lg-start me-2"
          backgroundColor="var(--alkarama-primary-color)"
          icon={<IoMdLogIn />}
        />
      </Form>
    </Fragment>
  );
}
export default LoginForm;
