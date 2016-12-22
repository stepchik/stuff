#!/usr/bin/python

import MySQLdb
from elizabeth import Personal, Address


def insert_data(name, pan, expiration, address):
    query = "INSERT INTO data(name, pan, expiration, address ) " \
            "VALUES(%s, %s, %s, %s)"
    args = (name, pan, expiration, address)

    try:
        conn =  MySQLdb.connect("localhost","root","admin","large_table" )
 
        cursor = conn.cursor()
        cursor.execute(query, args)
 
        if cursor.lastrowid:
            print('last insert id', cursor.lastrowid)
 
        conn.commit()
 
    finally:
        cursor.close()
        conn.close()

def get_card(sex='female'):
    user = Personal('is')
    user.full_name(sex),
    user.credit_card_expiration_date(maximum=21),
    user.credit_card_number(card_type='visa')
    
    address = Address('en')   	
    user.address = address.address
    return user

def main():
   user = Personal('is')

   for _ in range(0, 1000000):
       a = get_card()   	
       insert_data(a.full_name(), a.credit_card_number(), a.credit_card_expiration_date(), a.address())
 
if __name__ == '__main__':
    main()
