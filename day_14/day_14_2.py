from datetime import datetime

# Get Inputs
input_1 = 'SHHNCOPHONHFBVNKCFFC'

with open('./d14_data.txt') as f:
    input_2 = [line.rstrip('\n') for line in f.readlines()]
    
# digest the list as mapping rules
input_map = dict(d.split(" -> ") for d in input_2 )

now = datetime.now()

output = input_1
for i in range(1,41):
   
    out = ''
    for j in range( 0, len( output ) - 1 ):
        out = out + output[j]
        if ( output[j] + output[j + 1] ) in input_map:
            out = out +  input_map[output[j] + output[j + 1]]
    output = out + output[j+1]
    
    new = datetime.now()
    print( str(i) + "->" + str(len( output )) + " = " + str( new - now) )
    now = new
    
dict_char = {}
for char in output:
    if char in dict_char:
        dict_char[char] = dict_char[char] + 1
    else:
        dict_char[char] = 1

dict_sort = sorted(dict_char, key=dict_char.get)
        
print( dict_char[dict_sort[len(dict_char)-1]] - dict_char[dict_sort[0]] )
