# Hima-Pro Data Server

## Description
- A data storing php based server no database needed.

## Installation
- please change the variable <code>$datadir</code> value as you need to more secure your server's data.
- grant read/write permissions to the <code>index.php</code> file for the ability to manage the data.

## Usage

- This server for mini usage and more related to small projects.
- ### Storing data
  Endpoint: `/?action=new&value=#1` where #1 is data to store.
  <br> Example: `/?action=new&value=[1,2,3]`
  <br> Output: 
    ```
{
  "status": "ok",
  "result": "DDDBFC7d3E",
  "time": 1665266396,
  "auth": "Df4C22FAE"
} 
    ```
    you will need the <kbd>"auth"</kbd> in the editing actions (del, edit).

- ### Getting data
  Endpoint: `/?action=get&key=#1` where #1 is data key.
  <br> Example: `/?action=get&key=DDDBFC7d3E`
  <br> Output: 
    ```
{
  "status": "ok",
  "result": "[1,2,3]",
  "time": 1665266396
}
    ```

- ### Get All Keys
  Endpoint: `/?action=keys`
  <br> Example: `/?action=keys`
  <br> Output: 
    ```
{
  "status": "ok",
  "result": ["DDDBFC7d3E", "DKDBFC7d3F",....],
  "time": 1665270005
}
    ```
    This action is optional and you can disable it by setting the variable `$keys_use_state` to <kbd>false</kbd>

- ### Editing data
  Endpoint: `/?action=edit&key=#1&auth=#2&value=#3` where #1 is data key, #2 is auth key you got in the Storing data section and #3 new data.
  <br> Example: `/?action=edit&key=DDDBFC7d3E&auth=Df4C22FAE&value=[3,2,1]`
  <br> Output: 
    ```
{
  "status": "ok",
  "result": "success",
  "time": 1665268190
}
    ```

- ### Deleting data
  Endpoint: `/?action=del&key=#1&auth=#2` where #1 is data key and #2 is auth key you got in the Storing data section.
  <br> Example: `/?action=del&key=DDDBFC7d3E&auth=Df4C22FAE`
  <br> Output: 
    ```
{
  "status": "ok",
  "result": "success",
  "time": 1665268495
}
    ```

- ### Custom tag
  You can add `&tag=#1` to any endpoint where #1 is a special tag name to make your data separated.
  <br> Example: `/?action=new&tag=countyAndContinent&content={"County": "Egypt", "continent": "Africa"}`
  <br> Output: 
    ```
{
  "status": "ok",
  "result": "DDDBFC7d3E",
  "time": 1665266396,
  "auth": "Df4C22FAE"
} 
    ```

## Support and help
  - You can contact us to explain any problem you face when using our project by our contact details listed in our [Github Account](https://github.com/Hima-Pro).
  - You can open an Issue.

## License
- MIT License 
- You can edit this project as you need after Our Comments about Your Edition.

## Version
- v1.0(Beta)