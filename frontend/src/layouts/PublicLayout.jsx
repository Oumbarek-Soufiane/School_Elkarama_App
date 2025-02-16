import React, { Fragment } from "react";
import { Outlet } from "react-router-dom";
import PublicNavbar from "../components/common/public/PublicNavbar";


function PublicLayout() {

  return (
    <Fragment>
     <PublicNavbar/>
          <Outlet />
     
    </Fragment>
  );
}



export default PublicLayout;
