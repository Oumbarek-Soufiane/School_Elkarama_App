import React, { Fragment } from "react";
import { Outlet } from "react-router-dom";
import Header from "../components/common/dashboard/Header";
import SideBar from "./../components/common/dashboard/SideBar";
import classes from "./Layout.module.css"; 
import { useSelector } from "react-redux";

function DashboardLayout() {
  const isOpen = useSelector((state) => state.sidebar.isOpen);

  return (
    <Fragment>
      <Header />
      <SideBar />
      <main className={`${classes.main} ${isOpen ? classes.open : ''}`} id="main">
        <section className={classes.section}> 
          <Outlet />
        </section>
      </main>
    </Fragment>
  );
}



export default DashboardLayout;
