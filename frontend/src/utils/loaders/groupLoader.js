import axios from "axios";
import { AppURL } from "../../apis/AppURL";
import { getAuthToken } from "./../../utils/loaders/authLoader";

export async function groupLoader({ params }) {
  const authToken = getAuthToken();

  try {
    const [groupResponse, sectionsResponse] = await Promise.all([
      axios.get(AppURL.manageGroup(params.id), {
        headers: {
          Authorization: `Bearer ${authToken}`,
        },
      }),
      axios.get(AppURL.allSections(), {
        headers: {
          Authorization: `Bearer ${authToken}`,
        },
      }),
    ]);

    const groupData = groupResponse.data;
    const sectionsData = sectionsResponse.data;

    return { group: groupData.group, sections: sectionsData.sections };
  } catch (error) {
    console.error("Error fetching group or sections data:", error);
    throw new Error("Failed to load group or sections data.");
  }
}

export async function groupsLoader() {
  const authToken = getAuthToken();

  try {
    const response = await axios.get(AppURL.allGroups(), {
      headers: {
        Authorization: `Bearer ${authToken}`,
      },
    });
    return response.data;
  } catch (error) {
    console.error("Error fetching groups data:", error);
    throw new Error("Failed to load groups data.");
  }
}
