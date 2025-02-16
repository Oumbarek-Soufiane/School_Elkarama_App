import React, { useState } from "react";
import { useSelector } from "react-redux";
import {
  AdminDatasidebar,
  GuardianDatasidebar,
  StudentDatasidebar,
  TeacherDatasidebar,
} from "./Datasidebar";
import classes from "./SideBar.module.css";
import NavItem from "../../UI/navitems/NavItem";
import { getUserType } from "../../../utils/loaders";

function SideBar() {
  
  const isOpen = useSelector((state) => state.sidebar.isOpen);
  const userType = getUserType();

  const [expandedItemId, setExpandedItemId] = useState(null);

  const handleItemClick = (itemId) => {
    if (itemId === expandedItemId) {
      setExpandedItemId(null);
    } else {
      setExpandedItemId(itemId);
    }
  };

  const isItemExpanded = (itemId) => {
    return itemId === expandedItemId;
  };

  return (
    <div>
      <aside
        id="sidebar"
        className={`${classes.sidebar} ${
          isOpen ? classes.open : classes.closed
        }`}
      >
        <ul className={classes.sidebar_nav} id="sidebar-nav">
          {userType &&
            userType === "admin" &&
            AdminDatasidebar.map(
              (item) =>
                item.title && (
                  <NavItem
                    key={item.id}
                    item={item}
                    handleItemClick={handleItemClick}
                    isItemExpanded={isItemExpanded}
                  />
                )
            )}
          {userType === "teacher" &&
            TeacherDatasidebar.map((item) => (
              <NavItem
                key={item.id}
                item={item}
                handleItemClick={handleItemClick}
                isItemExpanded={isItemExpanded}
              />
            ))}
          {userType === "student" &&
            StudentDatasidebar.map((item) => (
              <NavItem
                key={item.id}
                item={item}
                handleItemClick={handleItemClick}
                isItemExpanded={isItemExpanded}
              />
            ))}
          {userType === "guardian" &&
            GuardianDatasidebar.map((item) => (
              <NavItem
                key={item.id}
                item={item}
                handleItemClick={handleItemClick}
                isItemExpanded={isItemExpanded}
              />
            ))}
        </ul>
      </aside>
    </div>
  );
}

export default SideBar;
