import React, { useEffect, Fragment } from "react";
import Input from "./../../UI/inputs/Input";
import Button from "./../../UI/buttons/Button";
import { BsDatabaseFill } from "react-icons/bs";
import { useActionData, Form, useNavigate } from "react-router-dom";
import { useDispatch } from "react-redux";
import { setSuccessMessage } from "./../../../redux/slices/successMessageSlice";

function BusForm({ method, bus }) {
  const actionData = useActionData();
  console.log(actionData); 
  const navigate = useNavigate();
  const dispatch = useDispatch();

  useEffect(() => {
    if (actionData && actionData.message && !actionData.errors) {
      dispatch(setSuccessMessage(actionData.message));
      navigate("/admin/buses/list");
    }
  }, [actionData, navigate, dispatch]);

  return (
    <Fragment>
      <Form method={method}>
        <Input
          label="Matricule"
          type="text"
          name="registration_number"
          defaultValue={bus ? bus.registration_number : ""}
          errorMessage={actionData && actionData.errors?.registration_number?.[0]}
          required
        />
        <Input
          label="Nombre de places"
          type="number"
          name="seating_capacity"
          defaultValue={bus ? bus.seating_capacity : ""}
          errorMessage={actionData && actionData.errors?.seating_capacity?.[0]}
          required
        />
        <Button
          text="Soumettre"
          type="submit"
          className="fw-bold float-lg-start me-2"
          backgroundColor="var(--alkarama-primary-color)"
          icon={<BsDatabaseFill />}
        />
      </Form>
    </Fragment>
  );
}

export default BusForm;
