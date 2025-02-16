import React, { useState } from "react";
import axios from "axios";
import { Link } from "react-router-dom";
import MUIDataTable from "mui-datatables";
import { HiOutlinePencilSquare } from "react-icons/hi2";
import { HiOutlineTrash } from "react-icons/hi";
import { AppURL } from "../../apis/AppURL";
import { getAuthToken } from "./../../utils/loaders/authLoader";
import Swal from "sweetalert2";
import { toast } from "react-toastify";

const ListStudentAttendance = ({ abscences }) => {
  const [attendList, setattendList] = useState(abscences);
  const authToken = getAuthToken();
console.log(abscences);
  const columns = [
    { name: "Libellé", options: { filter: false } },
    { name: "Description", options: { filter: false } },
    { name: "Responsable", options: { filter: false } },
    // {
    //   name: "Actions",
    //   options: {
    //     filter: false,
    //     customBodyRender: (value, tableMeta, updateValue) => {
    //       const levelId = levelList[tableMeta.rowIndex].id;
    //       return (
    //         <div>
    //           <Link
    //             to={`/admin/levels/${levelId}/edit`}
    //             className="btn btn-sm btn-primary mr-1"
    //           >
    //             <HiOutlinePencilSquare />
    //           </Link>
    //           <button
    //             className="btn btn-sm btn-danger"
    //             onClick={() => handleDelete(levelId)}
    //           >
    //             <HiOutlineTrash />
    //           </button>
    //         </div>
    //       );
    //     },
    //   },
    // },
  ];

  const options = {
    filterType: "checkbox",
  };

  return (
    <div>
      <MUIDataTable
        title={"Liste des abscences"}
        data={attendList.map((level) => [
          level.name,
          level.description,
          level.responsible_name,
        ])}
        columns={columns}
        options={options}
      />
    </div>
  );
};

export default ListStudentAttendance;
