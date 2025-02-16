import React, { useEffect, Fragment } from "react";
import Input from "./../../UI/inputs/Input";
import Button from "./../../UI/buttons/Button";
import { BsDatabaseFill } from "react-icons/bs";
import { useActionData, Form, useNavigate } from "react-router-dom";
import { useDispatch } from "react-redux";
import { setSuccessMessage } from "./../../../redux/slices/successMessageSlice";

function StaffForm({ method, buses, staff }) {
  const actionData = useActionData();
  console.log(actionData);
  const navigate = useNavigate();
  const dispatch = useDispatch();

  useEffect(() => {
    if (actionData && actionData.message && !actionData.errors) {
      dispatch(setSuccessMessage(actionData.message));
      navigate("/admin/transport-staff/list");
    }
  }, [actionData, navigate, dispatch]);

  return (
    <Fragment>
      <Form method={method}>
        <Input
          label="Bus"
          name="bus_id"
          selectOptions={buses.map((bus) => ({
            value: bus.id,
            label: bus.registration_number,
          }))}
          defaultValue={staff ? staff.bus_id : ""}
          errorMessage={actionData && actionData.errors?.bus_id?.[0]}
          required
        />
        <Input
          label="CIN"
          type="text"
          name="cin"
          defaultValue={staff ? staff.cin : ""}
          errorMessage={actionData && actionData.errors?.cin?.[0]}
          required
        />
        <Input
          label="Prenom"
          type="text"
          name="first_name"
          defaultValue={staff ? staff.first_name : ""}
          errorMessage={actionData && actionData.errors?.first_name?.[0]}
          required
        />
        <Input
          label="Nom"
          type="text"
          name="last_name"
          defaultValue={staff ? staff.last_name : ""}
          errorMessage={actionData && actionData.errors?.last_name?.[0]}
          required
        />
        <Input
          label="Date de naissane"
          type="date"
          name="date_of_birth"
          defaultValue={staff ? staff.date_of_birth : ""}
          errorMessage={actionData && actionData.errors?.date_of_birth?.[0]}
          required
        />
        <Input
          label="Genre"
          selectOptions={[
            { value: "male", label: "Male" },
            { value: "female", label: "Femelle" },
          ]}
          name="gender"
          defaultValue={staff ? staff.gender : ""}
          errorMessage={actionData && actionData.errors?.gender?.[0]}
          required
        />
        <Input
          label="Adresse"
          type="text"
          name="address"
          defaultValue={staff ? staff.address : ""}
          errorMessage={actionData && actionData.errors?.address?.[0]}
          required
        />
        <Input
          label="Email"
          type="email"
          name="email"
          defaultValue={staff ? staff.email : ""}
          errorMessage={actionData && actionData.errors?.email?.[0]}
          required
        />
        <Input
          label="Telephone"
          type="text"
          name="phone_number"
          defaultValue={staff ? staff.phone_number : ""}
          errorMessage={actionData && actionData.errors?.phone_number?.[0]}
          required
        />
        <Input
          label="Nationalite"
          type="text"
          name="nationality"
          defaultValue={staff ? staff.nationality : ""}
          errorMessage={actionData && actionData.errors?.nationality?.[0]}
          required
        />
        <Input
          label="Role"
          selectOptions={[
            { value: "driver", label: "Chauffeur " },
            { value: "assistant", label: "Assistant" },
          ]}
          name="role"
          defaultValue={staff ? staff.role : ""}
          errorMessage={actionData && actionData.errors?.role?.[0]}
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

export default StaffForm;
