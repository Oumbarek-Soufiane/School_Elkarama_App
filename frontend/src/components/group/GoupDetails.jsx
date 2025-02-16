import React, { Fragment } from "react";
import MUIDataTable from "mui-datatables";
import classes from "./GoupDetails.module.css"
const GroupDetails = ({ group, students }) => {
  const studentColumns = [
    { name: "Nom", options: { filter: false } },
    { name: "Prénom", options: { filter: false } },
    { name: "Email", options: { filter: false } },
  ];

  const studentOptions = {
    filterType: "checkbox",
  };

  return (
    <Fragment>
      <div className={classes.group_details}>
        <h2>Détails du Groupe</h2>
        <p>
          <strong>Libellé:</strong> {group.name}
        </p>
        <p>
          <strong>Classe:</strong> {group.section.name}
        </p>
        <p>
          <strong>Capacité:</strong> {group.capacity}
        </p>
        <p>
          <strong>Description:</strong> {group.description}
        </p>
      </div>
      <div className={classes.student_list}>
        <h2>Liste des Étudiants</h2>
        <MUIDataTable
          title={"Étudiants"}
          data={students.map((student) => [
            student.student_last_name,
            student.student_first_name,
            student.student_email,
          ])}
          columns={studentColumns}
          options={studentOptions}
        />
      </div>
    </Fragment>
  );
};

export default GroupDetails;
