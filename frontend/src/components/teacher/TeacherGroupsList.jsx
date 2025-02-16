import React from "react";
import { Link } from "react-router-dom";
import MUIDataTable from "mui-datatables";
import { IoEyeSharp } from "react-icons/io5";

const TeacherGroupsList = ({ groups }) => {
  const columns = [
    { name: "Nom", label: "Nom", options: { filter: false } },
    { name: "Section", label: "Section", options: { filter: true } },
    { name: "Description", label: "Description", options: { filter: false } },
    { name: "Capacité", label: "Capacité", options: { filter: false } },
    {
      name: "Action",
      label: "Action",
      options: {
        filter: false,
        customBodyRender: (value, tableMeta, updateValue) => {
          const groupId = groups[tableMeta.rowIndex].id;
          return (
            <div>
              <Link
                to={`/teacher/groups/${groupId}`}
                className="btn btn-sm btn-primary mr-1"
              >
                <IoEyeSharp />
              </Link>
            </div>
          );
        },
      },
    },
  ];

  const options = {
    filterType: "checkbox",
    selectableRows: "none",
  };

  return (
    <div>
      <MUIDataTable
        title={"Liste des groupes"}
        data={groups.map((group) => [
          group.name,
          group.section.name,
          group.description,
          group.capacity,
        ])}
        columns={columns}
        options={options}
      />
    </div>
  );
};

export default TeacherGroupsList;
